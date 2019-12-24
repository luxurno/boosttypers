<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Service\DownloadService;
use ArrayIterator;
use App\Bundle\DownloadBundle\Collection\ElementDTOCollection;
use App\Bundle\DownloadBundle\Generator\ElementGenerator;
use App\Bundle\DownloadBundle\Link\LinkContext;
use App\Bundle\DownloadBundle\Transformer\ContentTransformer;
use App\Bundle\DownloadBundle\Validator\ElementValidator;
use App\Bundle\DownloadBundle\ValueObject\DownloadValueObject;
use DateTime;
use PHPUnit\Framework\MockObject\MockObject;

class DownloadServiceTest extends \Codeception\Test\Unit
{
    private const ADDRESS = 'http://www.watchthedeer.com/photos';
    private const COUNT = 20;
    private $testArray = [
        [
            'link' => 'some-link',
            'title' => 'some-title',
        ],
    ];

    public function testDownloadMethodCallGenerateWhenValidated(): void
    {
        $this->testArray[0]['date'] = $this->createDateTime();
        $downloadValueObject = $this->createDownloadValueObject();
        $linkContext = $this->createLinkContext();
        $contentTransformer = $this->createContentTransformer();
        $createElementDTOCollection = $this->createElementDTOCollection();
        $elementDTO = $this->createElementDTO();
        $elementValidator = $this->createElementValidator();
        $elementGenerator = $this->createElementGenerator();

        $downloadValueObject->expects(self::once())->method('getAddress')->willReturn(self::ADDRESS);
        $downloadValueObject->expects(self::once())->method('getCount')->willReturn(self::COUNT);
        $linkContext->expects(self::once())->method('handle')->with(self::ADDRESS, self::COUNT)
            ->willReturn($this->testArray);
        $contentTransformer->expects(self::once())->method('transform')->with($this->testArray)
            ->willReturn($createElementDTOCollection);
        $createElementDTOCollection->method('getIterator')->willReturn(new ArrayIterator([$elementDTO]));
        $elementValidator->expects(self::once())->method('validate')->with($elementDTO)->willReturn(true);
        $elementGenerator->expects(self::once())->method('generate')->with($elementDTO);

        $downloadService = new DownloadService(
            $contentTransformer,
            $elementGenerator,
            $elementValidator,
            $linkContext
        );
        $downloadService->download($downloadValueObject);
    }

    public function testDownloadMethodCallGenerateWhenNotValidated(): void
    {
        $this->testArray[0]['date'] = $this->createDateTime();
        $downloadValueObject = $this->createDownloadValueObject();
        $linkContext = $this->createLinkContext();
        $contentTransformer = $this->createContentTransformer();
        $elementDTOCollection = $this->createElementDTOCollection();
        $elementDTO = $this->createElementDTO();
        $elementValidator = $this->createElementValidator();
        $elementGenerator = $this->createElementGenerator();

        $downloadValueObject->expects(self::once())->method('getAddress')->willReturn(self::ADDRESS);
        $downloadValueObject->expects(self::once())->method('getCount')->willReturn(self::COUNT);
        $linkContext->expects(self::once())->method('handle')->with(self::ADDRESS, self::COUNT)
            ->willReturn($this->testArray);
        $contentTransformer->expects(self::once())->method('transform')->with($this->testArray)
            ->willReturn($elementDTOCollection);
        $elementDTOCollection->method('getIterator')->willReturn(new ArrayIterator([$elementDTO]));
        $elementValidator->expects(self::once())->method('validate')->with($elementDTO)->willReturn(false);
        $elementGenerator->expects(self::never())->method('generate')->with($elementDTO);

        $downloadService = new DownloadService(
            $contentTransformer,
            $elementGenerator,
            $elementValidator,
            $linkContext
        );
        $downloadService->download($downloadValueObject);
    }

    private function createContentTransformer(): MockObject
    {
        return $this->createMock(ContentTransformer::class);
    }

    private function createElementGenerator(): MockObject
    {
        return $this->createMock(ElementGenerator::class);
    }

    private function createElementValidator(): MockObject
    {
        return $this->createMock(ElementValidator::class);
    }

    private function createLinkContext(): MockObject
    {
        return $this->createMock(LinkContext::class);
    }

    private function createDownloadValueObject(): MockObject
    {
        return $this->createMock(DownloadValueObject::class);
    }

    private function createElementDTOCollection(): MockObject
    {
        return $this->createMock(ElementDTOCollection::class);
    }
    private function createDateTime(): MockObject
    {
        return $this->createMock(DateTime::class);
    }

    private function createElementDTO(): MockObject
    {
        return $this->createMock(ElementDTO::class);
    }
}
