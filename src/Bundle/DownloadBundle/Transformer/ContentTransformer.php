<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Transformer;

use App\Bundle\DownloadBundle\Collection\ElementDTOCollection;
use App\Bundle\DownloadBundle\Factory\ElementDTOFactory;
use Exception;
use PHPHtmlParser\Dom;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ContentTransformer
{
    /** @var ElementDTOFactory */
    private $elementDTOFactory;
    
    /**
     * @param ElementDTOFactory $elementDTOFactory
     */
    public function __construct(ElementDTOFactory $elementDTOFactory)
    {
        $this->elementDTOFactory = $elementDTOFactory;
    }
    
    /**
     * @param Dom $dom
     * @param int $count
     * 
     * @return ElementDTOCollection
     */
    public function transform(Dom $dom, int $count): ElementDTOCollection
    {
        $array = [];
        
        for ($i=$count; $i>= 1; $i--) {
            try {
                $elementDTO = $this->elementDTOFactory->factory();
                
                $elementDTO->setLink($dom->find("#content a", $i)->href);
                $elementDTO->setTitle($dom->find("#content a", $i)->innerHtml);
                $array[] = $elementDTO;
            } catch (Exception $ex) {
            }
        }
        
        return new ElementDTOCollection(... $array);
    }
}
