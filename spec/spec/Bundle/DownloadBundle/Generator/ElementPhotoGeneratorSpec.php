<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Generator;

use App\Bundle\DownloadBundle\Collection\ElementPhotoDTOCollection;
use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\DTO\ElementPhotoDTO;
use App\Bundle\DownloadBundle\Entity\Element;
use App\Bundle\DownloadBundle\Generator\ElementPhotoGenerator;
use App\Bundle\DownloadBundle\Repository\ElementRepository;
use ArrayIterator;
use Doctrine\ORM\EntityManagerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class ElementPhotoGeneratorSpec extends ObjectBehavior
{
    private const ID = 1;
    private const IS_VIDEO = true;
    private const PHOTO_NUMBER = 1;

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ElementPhotoGenerator::class);
    }

    public function let(
        EntityManagerInterface $entityManager,
        ElementRepository $elementRepository,
        CommandBus $commandBus
    ): void
    {
        $this->beConstructedWith(
            $entityManager,
            $elementRepository,
            $commandBus
        );
    }

    public function it_should_generate_photos(
        Element $elementEntity,
        ElementRepository $elementRepository,
        EntityManagerInterface $entityManager,
        ElementPhotoDTOCollection $elementPhotoDTOCollection,
        CommandBus $commandBus,
        ElementDTO $elementDTO
    ): void
    {
        $elementDTO->getId()->willReturn(self::ID);
        $elementDTO->getIsVideo()->willReturn(self::IS_VIDEO);
        $elementDTO->getPhotoNumber()->willReturn(self::PHOTO_NUMBER);
        $elementRepository->findOneBy(['id' => self::ID])->shouldBeCalled()
            ->willReturn($elementEntity);

        $elementEntity->setIsVideo()->withArguments([true])->shouldBeCalled();
        $elementEntity->setPhotoNumber()->withArguments([self::PHOTO_NUMBER])->shouldBeCalled();
        $entityManager->persist($elementEntity)->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $elementPhotoDTOCollection->getIterator()->shouldBeCalled()->willReturn(new ArrayIterator([new ElementPhotoDTO()]));

        $commandBus->handle(Argument::any())->shouldBeCalled();

        $this->generatePhotos($elementDTO, $elementPhotoDTOCollection);
    }
}
