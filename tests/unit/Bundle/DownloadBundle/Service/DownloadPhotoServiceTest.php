<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Collection\ElementPhotoDTOCollection;
use App\Bundle\DownloadBundle\Converter\WebsiteConverter;
use App\Bundle\DownloadBundle\Download\DownloadContext;
use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Factory\ElementDTOFactory;
use App\Bundle\DownloadBundle\Finder\ElementFinder;
use App\Bundle\DownloadBundle\Generator\ElementPhotoGenerator;
use App\Bundle\DownloadBundle\Service\DownloadPhotoService;
use App\Bundle\DownloadBundle\Transformer\ContentPhotoTransformer;
use App\Bundle\DownloadBundle\Validator\ElementPhotoValidator;
use App\Bundle\DownloadBundle\ValueObject\DownloadValueObject;
use PHPUnit\Framework\MockObject\MockObject;

class DownloadPhotoServiceTest extends \Codeception\Test\Unit
{
    private const ADDRESS = 'http://www.watchthedeer.com/photos';
    private const COUNT = 20;
    private const CONVERTED = 'http://www.watchthedeer.com/looping_images/Abilene%20Sept%202015/viewer.aspx';
    private $testArray = [
        [
            'id' => 2,
            'link' => '../looping_images/Abilene%20Sept%202015/viewer.aspx',
            'title' => 'Exotic Animals (300 images) - Texas',
        ],
    ];
    private $photos = [
        'http://www.watchthedeer.com/looping_images/Abilene%20Sept%202015/photo1.jpg',
    ];

    public function testDownloadPhotosOnElement(): void
    {
        $elementFinder = $this->createElementFinder();
        $elementDTOFactory = $this->createElementDTOFactory();
        $elementDTO = $this->createElementDTO();
        $downloadValueObject = $this->createDownloadValueObject();
        $websiteConverter = $this->createWebsiteConverter();
        $downloadContext = $this->createDownloadContext();
        $contentPhotoTransformer = $this->createContentPhotoTransformer();
        $elementPhotoDTOCollection = $this->createElementPhotoDTOCollection();
        $elementPhotoValidator = $this->createElementPhotoValidator();
        $elementPhotoGenerator = $this->createElementPhotoGenerator();

        $elementFinder->expects(self::once())->method('findMissingPhotos')
            ->willReturn($this->testArray);
        $elementDTOFactory->expects(self::once())->method('factory')->willReturn($elementDTO);
        $elementDTO->expects(self::once())->method('setId')->with($this->testArray[0]['id']);
        $elementDTO->expects(self::once())->method('setTitle')->with($this->testArray[0]['title']);
        $elementDTO->expects(self::once())->method('setLink')->with($this->testArray[0]['link']);
        $downloadValueObject->expects(self::once())->method('getAddress')->willReturn(self::ADDRESS);
        $downloadValueObject->method('getCount')->willReturn(self::COUNT);
        $websiteConverter->expects(self::once())->method('convert')->with(self::ADDRESS, $elementDTO->getLink())
            ->willReturn(self::CONVERTED);
        $downloadContext->expects(self::once())->method('handle')->with(self::CONVERTED)
            ->willReturn($this->photos);
        $contentPhotoTransformer->expects(self::once())->method('transform')->willReturn($elementPhotoDTOCollection);

        $elementPhotoValidator->expects(self::once())->method('validate')->with($elementDTO->getLink())
            ->willReturn(true);
        $elementDTO->expects(self::once())->method('setIsVideo')->with(false);
        $elementDTO->expects(self::once())->method('setPhotoNumber')->with(count($elementPhotoDTOCollection));

        $downloadPhotoService = new DownloadPhotoService(
            $contentPhotoTransformer,
            $elementPhotoGenerator,
            $websiteConverter,
            $elementFinder,
            $elementDTOFactory,
            $downloadContext,
            $elementPhotoValidator
        );

        $downloadPhotoService->downloadPhotos($downloadValueObject);
    }

    public function testDownloadPhotosOnElementSetIsVideoCorrectly(): void
    {
        $elementFinder = $this->createElementFinder();
        $elementDTOFactory = $this->createElementDTOFactory();
        $elementDTO = $this->createElementDTO();
        $downloadValueObject = $this->createDownloadValueObject();
        $websiteConverter = $this->createWebsiteConverter();
        $downloadContext = $this->createDownloadContext();
        $contentPhotoTransformer = $this->createContentPhotoTransformer();
        $elementPhotoDTOCollection = $this->createElementPhotoDTOCollection();
        $elementPhotoValidator = $this->createElementPhotoValidator();
        $elementPhotoGenerator = $this->createElementPhotoGenerator();

        $elementFinder->expects(self::once())->method('findMissingPhotos')
            ->willReturn($this->testArray);
        $elementDTOFactory->expects(self::once())->method('factory')->willReturn($elementDTO);
        $elementDTO->expects(self::once())->method('setId')->with($this->testArray[0]['id']);
        $elementDTO->expects(self::once())->method('setTitle')->with($this->testArray[0]['title']);
        $elementDTO->expects(self::once())->method('setLink')->with($this->testArray[0]['link']);
        $downloadValueObject->expects(self::once())->method('getAddress')->willReturn(self::ADDRESS);
        $downloadValueObject->method('getCount')->willReturn(self::COUNT);
        $websiteConverter->expects(self::once())->method('convert')->with(self::ADDRESS, $elementDTO->getLink())
            ->willReturn(self::CONVERTED);
        $downloadContext->expects(self::once())->method('handle')->with(self::CONVERTED)
            ->willReturn($this->photos);
        $contentPhotoTransformer->expects(self::once())->method('transform')->willReturn($elementPhotoDTOCollection);

        $elementPhotoValidator->expects(self::once())->method('validate')->with($elementDTO->getLink())
            ->willReturn(false);
        $elementDTO->expects(self::once())->method('setIsVideo')->with(true);
        $elementDTO->expects(self::once())->method('setPhotoNumber')->with(count($elementPhotoDTOCollection));

        $downloadPhotoService = new DownloadPhotoService(
            $contentPhotoTransformer,
            $elementPhotoGenerator,
            $websiteConverter,
            $elementFinder,
            $elementDTOFactory,
            $downloadContext,
            $elementPhotoValidator
        );

        $downloadPhotoService->downloadPhotos($downloadValueObject);
    }

    private function createElementFinder(): MockObject
    {
        return $this->createMock(ElementFinder::class);
    }

    private function createElementDTOFactory(): MockObject
    {
        return $this->createMock(ElementDTOFactory::class);
    }

    private function createElementDTO(): MockObject
    {
        return $this->createMock(ElementDTO::class);
    }

    private function createDownloadValueObject(): MockObject
    {
        return $this->createMock(DownloadValueObject::class);
    }

    private function createWebsiteConverter(): MockObject
    {
        return $this->createMock(WebsiteConverter::class);
    }

    private function createDownloadContext(): MockObject
    {
        return $this->createMock(DownloadContext::class);
    }

    private function createContentPhotoTransformer(): MockObject
    {
        return $this->createMock(ContentPhotoTransformer::class);
    }

    private function createElementPhotoDTOCollection(): MockObject
    {
        return $this->createMock(ElementPhotoDTOCollection::class);
    }

    private function createElementPhotoValidator(): MockObject
    {
        return $this->createMock(ElementPhotoValidator::class);
    }

    private function createElementPhotoGenerator(): MockObject
    {
        return $this->createMock(ElementPhotoGenerator::class);
    }
}
