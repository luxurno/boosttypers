<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Link\Strategy;

use App\Bundle\DownloadBundle\Converter\DateConverter;
use App\Bundle\DownloadBundle\Exception\DownloadElementException;
use Exception;
use PHPHtmlParser\Dom;
use Throwable;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DefaultLinkStrategy extends AbstractStrategy
{
    /** @var DateConverter */
    private $dateConverter;

    public function __construct(DateConverter $dateConverter)
    {
        $this->dateConverter = $dateConverter;

    }

    /**
     * @param string $website
     * @return bool
     */
    public function isValid(string $website): bool
    {
        if (strpos(strtolower($website), '/photos') !== false) {
            return true;
        }

        return false;
    }

    /**
     * @param string $website
     * @param int $count
     * @return array
     * @throws DownloadElementException
     */
    public function getLinks(string $website, int $count): array
    {
        try {
            $dom = new Dom;
            $dom->loadFromUrl($website);
        } catch(Throwable $e) {
            printf("Could not download Elements: %s", $e->getMessage());
            throw new DownloadElementException();
        }

        $array = [];
        $element = [];
        for ($i=$count; $i>= 1; $i--) {
            try {
                $element['link'] = $dom->find("#content a", $i)->href;
                $element['title'] = $dom->find("#content a", $i)->innerHtml;
                $element['date'] = $this->dateConverter->convert($element['link'], $element['title']);
                $array[] = $element;
            } catch (Exception $ex) {
            }
        }

        return $array;
    }
}