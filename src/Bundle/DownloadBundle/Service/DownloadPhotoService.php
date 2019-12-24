<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Converter\WebsiteConverter;
use App\Bundle\DownloadBundle\Download\DownloadContext;
use App\Bundle\DownloadBundle\Download\Exception\InvalidStrategyException;
use App\Bundle\DownloadBundle\Factory\ElementDTOFactory;
use App\Bundle\DownloadBundle\Finder\ElementFinder;
use App\Bundle\DownloadBundle\Generator\ElementPhotoGenerator;
use App\Bundle\DownloadBundle\Transformer\ContentPhotoTransformer;
use App\Bundle\DownloadBundle\Validator\ElementPhotoValidator;
use App\Bundle\DownloadBundle\Validator\PhotoElementLinkValidator;
use App\Bundle\DownloadBundle\ValueObject\DownloadValueObject;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadPhotoService
{
    /** @var ContentPhotoTransformer */
    private $contentPhotoTransformer;
    
    /** @var ElementPhotoGenerator */
    private $elementPhotoGenerator;
    
    /** @var WebsiteConverter */
    private $websiteConverter;

    /** @var ElementFinder */
    private $elementFinder;

    /** @var ElementDTOFactory */
    private $elementDTOFactory;

    /** @var DownloadContext */
    private $downloadContext;

    /** @var ElementPhotoValidator */
    private $elementPhotoValidator;

    /**
     * @param ContentPhotoTransformer $contentPhotoTransformer
     * @param ElementPhotoGenerator $elementPhotoGenerator
     * @param WebsiteConverter $websiteConverter
     * @param ElementFinder $elementFinder
     * @param ElementDTOFactory $elementDTOFactory
     * @param DownloadContext $downloadContext
     * @param ElementPhotoValidator $elementPhotoValidator
     */
    public function __construct(
        ContentPhotoTransformer $contentPhotoTransformer,
        ElementPhotoGenerator $elementPhotoGenerator,
        WebsiteConverter $websiteConverter,
        ElementFinder $elementFinder,
        ElementDTOFactory $elementDTOFactory,
        DownloadContext $downloadContext,
        ElementPhotoValidator $elementPhotoValidator
    )
    {
        $this->contentPhotoTransformer = $contentPhotoTransformer;
        $this->elementPhotoGenerator = $elementPhotoGenerator;
        $this->websiteConverter = $websiteConverter;
        $this->elementFinder = $elementFinder;
        $this->elementDTOFactory = $elementDTOFactory;
        $this->downloadContext = $downloadContext;
        $this->elementPhotoValidator = $elementPhotoValidator;
    }

    /**
     * @param DownloadValueObject $downloadValueObject
     * @throws InvalidStrategyException
     */
    public function downloadPhotos(DownloadValueObject $downloadValueObject): void
    {
        $elements = $this->elementFinder->findMissingPhotos();

        foreach ($elements as $element) {
            $elementDTO = $this->elementDTOFactory->factory();
            $elementDTO->setId($element['id']);
            $elementDTO->setTitle($element['title']);
            $elementDTO->setLink($element['link']);

            $website = $this->websiteConverter->convert($downloadValueObject->getAddress(), $elementDTO->getLink());
            $photos = $this->downloadContext->handle($website);
            $elementPhotoDTOCollection = $this->contentPhotoTransformer->transform($photos);

            if ($this->elementPhotoValidator->validate($elementDTO->getLink())) {
                $elementDTO->setIsVideo(false);
            } else {
                $elementDTO->setIsVideo(true);
            }
            $elementDTO->setPhotoNumber(count($elementPhotoDTOCollection));

            $this->elementPhotoGenerator->generatePhotos($elementDTO, $elementPhotoDTOCollection);
        }
    }
}
