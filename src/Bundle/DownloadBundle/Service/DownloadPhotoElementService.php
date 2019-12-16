<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Converter\WebsiteConverter;
use App\Bundle\DownloadBundle\Transformer\ContentPhotoTransformer;
use App\Bundle\DownloadBundle\Validator\PhotoElementLinkValidator;
use PHPHtmlParser\Dom;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadPhotoElementService
{
    /** @var WebsiteConverter */
    private $websiteConverter;
    
    /** @var PhotoElementLinkValidator */
    private $photoElementLinkValidator;
    
    /** @var ContentPhotoTransformer */
    private $contentPhotoTransformer;
    
    public function __construct(
        WebsiteConverter $websiteConverter,
        PhotoElementLinkValidator $photoElementLinkValidator,
        ContentPhotoTransformer $contentPhotoTransformer
    )
    {
        $this->websiteConverter = $websiteConverter;
        $this->photoElementLinkValidator = $photoElementLinkValidator;
        $this->contentPhotoTransformer = $contentPhotoTransformer;
    }
    
    /**
     * @param string $link
     */
    public function getPhotos(string $address, string $link): array
    {
        $website = $this->websiteConverter->convert($address, $link);
        
        if ($this->photoElementLinkValidator->validate($website)) {
            $website = "http://www.watchthedeer.com/looping_images/Abilene%20Sept%202015/viewer";
            $dom = new Dom;
            $dom->loadFromUrl($website);
            
            echo "<br/>";
            
            echo "Url: ".$website."<br/>";
        
            echo "Pobieram Zdjęcia!</br>";
            
            $elementPhotoDTO = $this->contentPhotoTransformer->transform($dom);
            

            die;
        } else {
            echo "Filmik<br/>";
            echo "Url: ".$website."<br/>";
        }
        
        return [];
    }
}
