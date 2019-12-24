<?php

namespace spec\App\Bundle\DownloadBundle\Generator\Handler;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\DTO\ElementPhotoDTO;
use App\Bundle\DownloadBundle\Entity\Element;
use App\Bundle\DownloadBundle\Entity\ElementPhoto;
use App\Bundle\DownloadBundle\Factory\ElementFactory;
use App\Bundle\DownloadBundle\Factory\ElementPhotoFactory;
use App\Bundle\DownloadBundle\Generator\Command\SaveElementPhotoCommand;
use App\Bundle\DownloadBundle\Generator\Handler\SaveElementPhotoHandler;
use App\Bundle\DownloadBundle\Repository\ElementRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SaveElementPhotoHandlerSpec extends ObjectBehavior
{
    private const ID = 1;
    private const HREF = 'some-href';

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(SaveElementPhotoHandler::class);
    }

    public function let(
        EntityManagerInterface $entityManager,
        ElementRepository $elementRepository,
        ElementPhotoFactory $elementPhotoFactory
    ): void
    {
        $this->beConstructedWith(
            $entityManager,
            $elementRepository,
            $elementPhotoFactory
        );
    }

    public function it_should_create_new_element_photo_entity(
        SaveElementPhotoCommand $saveElementPhotoCommand,
        ElementDTO $elementDTO,
        ElementPhotoDTO $elementPhotoDTO,
        EntityManagerInterface $entityManager,
        ElementPhotoFactory $elementPhotoFactory,
        ElementPhoto $elementPhoto,
        ElementRepository $elementRepository,
        Element $element
    ): void
    {
        $saveElementPhotoCommand->getElementDTO()->willReturn($elementDTO);
        $saveElementPhotoCommand->getElementPhotoDTO()->willReturn($elementPhotoDTO);
        $elementDTO->getId()->willReturn(self::ID);
        $elementPhotoDTO->getHref()->willReturn(self::HREF);
        $elementRepository->findOneBy(Argument::any())->willReturn($element);

        $elementPhotoFactory->factory()->willReturn($elementPhoto);
        $elementPhoto->setHref(self::HREF)->shouldBeCalled();

        $elementPhotoDTO->getHref()->shouldBeCalled();
        $entityManager->persist(Argument::any())->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $this->handle($saveElementPhotoCommand);
    }
}
