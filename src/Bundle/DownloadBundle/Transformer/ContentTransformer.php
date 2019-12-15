<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Transformer;

use App\Bundle\DownloadBundle\Factory\ElementDTOFactory;
use App\Bundle\DownloadBundle\Generator\ElementGenerator;
use Exception;
use PHPHtmlParser\Dom;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ContentTransformer
{
    /** @var ElementDTOFactory */
    private $elementDTOFactory;
    
    /** @var ElementGenerator */
    private $elementGenerator;
    
    /**
     * @param ContentGenerator $contentGenerator
     */
    public function __construct(
        ElementDTOFactory $elementDTOFactory,
        ElementGenerator $elementGenerator
    )
    {
        $this->elementDTOFactory = $elementDTOFactory;
        $this->elementGenerator = $elementGenerator;
    }
    /**
     * @param string $address
     */
    public function transform(Dom $dom)
    {
        for ($i=500; $i>= 1; $i--) {
            try {
                $elementDTO = $this->elementDTOFactory->factory();
                
                $elementDTO->setLink($dom->find("#content a", $i)->href);
                $elementDTO->setTitle($dom->find("#content a", $i)->innerHtml);
                $this->elementGenerator->generate($elementDTO);
            } catch (Exception $ex) {
                echo $ex->getMessage()."<br/>";
            }
        }
    }
}
