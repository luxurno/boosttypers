<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Transformer;

use App\Bundle\DownloadBundle\DTO\ElementPhotoDTO;
use App\Bundle\DownloadBundle\Factory\ElementPhotoDTOFactory;
use App\Bundle\DownloadBundle\Transformer\ContentPhotoTransformer;
use PHPUnit\Framework\MockObject\MockObject;

class ContentPhotoTransformerTest extends \Codeception\Test\Unit
{
    private $testArray = [
        'some-href',
    ];

    public function testTransformMethod(): void
    {
        $elementPhotoDTOFactory = $this->createElementPhotoDTOFactory();
        $elementPhotoDTO = $this->createElementPhotoDTO();

        $elementPhotoDTOFactory->expects(self::once())->method('factory')->willReturn($elementPhotoDTO);
        $elementPhotoDTO->expects(self::once())->method('setHref')->with($this->testArray[0]);

        $contentPhotoTransformer = new ContentPhotoTransformer($elementPhotoDTOFactory);
        $contentPhotoTransformer->transform($this->testArray);
    }

    public function testTransformMethodOnEmptyParams(): void
    {
        $this->testArray = [];
        $elementPhotoDTOFactory = $this->createElementPhotoDTOFactory();
        $elementPhotoDTO = $this->createElementPhotoDTO();

        $elementPhotoDTOFactory->expects(self::never())->method('factory')->willReturn($elementPhotoDTO);
        $elementPhotoDTO->expects(self::never())->method('setHref')->with($this->testArray);

        $contentPhotoTransformer = new ContentPhotoTransformer($elementPhotoDTOFactory);
        $contentPhotoTransformer->transform($this->testArray);
    }

    private function createElementPhotoDTO(): MockObject
    {
        return $this->createMock(ElementPhotoDTO::class);
    }

    private function createElementPhotoDTOFactory(): MockObject
    {
        return $this->createMock(ElementPhotoDTOFactory::class);
    }
}
