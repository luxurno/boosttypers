<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Validator;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Repository\ElementRepository;
use App\Bundle\DownloadBundle\Validator\ElementValidator;
use PHPUnit\Framework\MockObject\MockObject;

class ElementValidatorTest extends \Codeception\Test\Unit
{
    private const LINK = 'some-link';
    private const TITLE = 'some-title';

    public function testValidateFunctionOnEmptyGetTitle(): void
    {
        $elementDTO = $this->createElementDTO();
        $elementDTO->method('getTitle')->willReturn('');

        $elementValidator = new ElementValidator($this->createElementRepository());
        $this->assertFalse($elementValidator->validate($elementDTO));
    }

    public function testValidateFunctionOnEmptyGetLink(): void
    {
        $elementDTO = $this->createElementDTO();
        $elementDTO->method('getLink')->willReturn('');

        $elementValidator = new ElementValidator($this->createElementRepository());
        $this->assertFalse($elementValidator->validate($elementDTO));
    }

    public function testValidateFunctionOnExistElement(): void
    {
        $elementDTO = $this->createElementDTO();
        $elementDTO->method('getTitle')->willReturn(self::TITLE);
        $elementDTO->method('getLink')->willReturn(self::LINK);

        $elementRepository = $this->createElementRepository();
        $elementRepository->method('exist')->with(['link' => $elementDTO->getLink()])->willReturn(true);

        $elementValidator = new ElementValidator($elementRepository);
        $this->assertFalse($elementValidator->validate($elementDTO));
    }

    public function testValidateFunctionOnNotExistElement(): void
    {
        $elementDTO = $this->createElementDTO();
        $elementDTO->method('getTitle')->willReturn(self::TITLE);
        $elementDTO->method('getLink')->willReturn(self::LINK);

        $elementRepository = $this->createElementRepository();
        $elementRepository->method('exist')->with(['link' => $elementDTO->getLink()])->willReturn(false);

        $elementValidator = new ElementValidator($elementRepository);
        $this->assertTrue($elementValidator->validate($elementDTO));
    }

    private function createElementRepository(): MockObject
    {
        return $this->createMock(ElementRepository::class);
    }

    private function createElementDTO(): MockObject
    {
        return $this->createMock(ElementDTO::class);
    }
}