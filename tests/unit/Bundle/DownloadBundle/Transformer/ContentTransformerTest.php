<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Transformer;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Factory\ElementDTOFactory;
use App\Bundle\DownloadBundle\Transformer\ContentTransformer;
use DateTime;
use PHPUnit\Framework\MockObject\MockObject;

class ContentTransformerTest extends \Codeception\Test\Unit
{
    private $testArray = [
        [
            'link' => 'some-link',
            'title' => 'some-title',
        ],
    ];

    public function testTransformMethod(): void
    {
        $this->testArray[0]['date'] = $this->createDateTime();
        $elementDTOFactory = $this->createElementDTOFactory();
        $elementDTO = $this->createElementDTO();

        $elementDTOFactory->expects(self::once())->method('factory')->willReturn($elementDTO);
        $elementDTO->expects(self::once())->method('setLink')->with($this->testArray[0]['link']);
        $elementDTO->expects(self::once())->method('setTitle')->with($this->testArray[0]['title']);
        $elementDTO->expects(self::once())->method('setDate')->with($this->testArray[0]['date']);

        $contentTransformer = new ContentTransformer($elementDTOFactory);
        $contentTransformer->transform($this->testArray);
    }

    public function testTransformMethodOnEmptyParams(): void
    {
        $this->testArray = [];
        $elementDTOFactory = $this->createElementDTOFactory();
        $elementDTO = $this->createElementDTO();

        $elementDTOFactory->expects(self::never())->method('factory');
        $elementDTO->expects(self::never())->method('setLink');
        $elementDTO->expects(self::never())->method('setTitle');
        $elementDTO->expects(self::never())->method('setDate');

        $contentTransformer = new ContentTransformer($elementDTOFactory);
        $contentTransformer->transform($this->testArray);
    }

    private function createElementDTO(): MockObject
    {
        return $this->createMock(ElementDTO::class);
    }

    private function createElementDTOFactory(): MockObject
    {
        return $this->createMock(ElementDTOFactory::class);
    }

    private function createDateTime(): MockObject
    {
        return $this->createMock(DateTime::class);
    }
}
