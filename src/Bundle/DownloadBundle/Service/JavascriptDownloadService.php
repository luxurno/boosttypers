<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Converter\JavascriptTagConverter;
use App\Bundle\DownloadBundle\Converter\VideoConverter;
use App\Bundle\DownloadBundle\Exception\JavascriptDownloadPhotoException;
use PHPHtmlParser\Dom;
use Throwable;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

define('COOKIE_FILE', __DIR__.'/cookie.txt');
@unlink(COOKIE_FILE);

define('CURL_LOG_FILE', __DIR__.'/request.txt');
@unlink(CURL_LOG_FILE);//clear curl log
/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class JavascriptDownloadService
{
    /** @var JavascriptTagConverter */
    private $javascriptTagConverter;

    /** @var VideoConverter */
    private $videoConverter;

    /** @var ContainerBagInterface */
    private $containerBag;

    /** @var string */
    public $lastUrl = '';

    /** @var Dom|bool */
    public $dom = false;

    public function __construct(
        JavascriptTagConverter $javascriptTagConverter,
        VideoConverter $videoConverter,
        ContainerBagInterface $containerBag
    )
    {
        $this->javascriptTagConverter = $javascriptTagConverter;
        $this->videoConverter = $videoConverter;
        $this->containerBag = $containerBag;
    }

    /**
     * @param $url
     * @param $post
     * @return Dom|bool
     * @throws JavascriptDownloadPhotoException
     */
    public function getDom($url, $post = false) {
        $this->dom = new Dom();
        $this->stdeer = '';

        if($this->lastUrl) $header[] = "Referer: {$this->lastUrl}";
        $curlOptions = array(
            CURLOPT_ENCODING => 'gzip, deflate',
            CURLOPT_AUTOREFERER => 1,
            CURLOPT_CONNECTTIMEOUT => 60,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_VERBOSE => true,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36",
            CURLOPT_COOKIEFILE => COOKIE_FILE,
            CURLOPT_COOKIEJAR => COOKIE_FILE,
            CURLOPT_VERBOSE => true,
        );
        if(false !== $post) {
            $curlOptions[CURLOPT_POSTFIELDS] = $post;
            $curlOptions[CURLOPT_POST] = true;
        }
        $curl = curl_init();
        $verbose = fopen('php://temp', 'w+'); // Disabling cURL Headers output in tests and commands
        curl_setopt($curl, CURLOPT_STDERR, $verbose); // Disabling cURL Headers output in tests and commands

        curl_setopt_array($curl, $curlOptions);
        $data = curl_exec($curl);
        $this->lastUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        try {
            $dom = $this->dom->load($data);
        } catch (Throwable $e) {
            throw new JavascriptDownloadPhotoException($e->getMessage(), $e->getCode());
        }
        curl_close($curl);

        return $dom;
    }

    /**
     * @param array $params
     * @return string
     * @throws JavascriptDownloadPhotoException
     */
    function createASPPostParams(array $params): string
    {
        try {
            $postData = $this->dom->find('input');
        } catch (Throwable $e) {
            throw new JavascriptDownloadPhotoException($e->getMessage(), $e->getCode());
        }
        $postFields = [];
        foreach($postData as $d) {
            $name = $d->name;
            $value = isset($params[$name]) ? $params[$name] : $d->value;
            $postFields[] = rawurlencode($name).'='.rawurlencode($value);
        }
        $postFields = implode('&', $postFields);

        return $postFields;
    }

    /**
     * @param string $url
     * @param array $params
     * @return bool|Dom
     * @throws JavascriptDownloadPhotoException
     */
    function doPostRequest(string $url, array $params)
    {
        $post = $this->createASPPostParams($params);
        return $this->getDom($url, $post);
    }

    /**
     * @param $url
     * @return bool|Dom
     * @throws JavascriptDownloadPhotoException
     */
    function doGetRequest(string $url): Dom
    {
        return $this->getDom($url);
    }

    /**
     * @param string $website
     * @return string
     * @throws JavascriptDownloadPhotoException
     */
    public function getVideo(string $website): string
    {
        $tag = $this->javascriptTagConverter->convert($website);

        $url = $this->containerBag->get('download.address');
        $resultGetPage = $this->doGetRequest($url);

        try {
            $this->doPostRequest($url, [
                '__EVENTTARGET' => $tag,
                '__EVENTARGUMENT' => '',
                '__VIEWSTATE' => $resultGetPage->find('#__VIEWSTATE', 0)->value,
                '__VIEWSTATEGENERATOR' => $resultGetPage->find('#__VIEWSTATEGENERATOR', 0)->value,
                '__EVENTVALIDATION' => $resultGetPage->find('#__EVENTVALIDATION', 0)->value,
            ]);
        } catch (Throwable $e) {
            throw new JavascriptDownloadPhotoException($e->getMessage(), $e->getCode());
        }

        $resultPage = $this->doGetRequest($this->lastUrl);
        try {
            $video = $resultPage->find('#vidOne', 0)->src;
        } catch (Throwable $e) {
            throw new JavascriptDownloadPhotoException($e->getMessage(), $e->getCode());
        }

        return $this->videoConverter->convert($this->lastUrl, $video);
    }
}