<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Generator\Handler;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Entity\Element;
use App\Bundle\DownloadBundle\Factory\ElementFactory;
use App\Bundle\DownloadBundle\Generator\Command\SaveElementCommand;
use App\Bundle\DownloadBundle\Generator\Handler\SaveElementHandler;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SaveElementHandlerSpec extends ObjectBehavior
{
    private const LINK = 'some-link';
    private const TITLE = 'some-title';

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(SaveElementHandler::class);
    }

    public function let(
        EntityManagerInterface $entityManager,
        ElementFactory $elementFactory
    ): void
    {
        $this->beConstructedWith(
            $entityManager,
            $elementFactory
        );
    }

    public function it_should_create_new_element_entity(
        SaveElementCommand $saveElementCommand,
        ElementDTO $elementDTO,
        EntityManagerInterface $entityManager,
        ElementFactory $elementFactory,
        Element $element
    ): void
    {
        $saveElementCommand->getElementDTO()->shouldBeCalled()->willReturn($elementDTO);
        $elementFactory->factory()->willReturn($element);
        $elementDTO->getLink()->willReturn(self::LINK);
        $elementDTO->getTitle()->willReturn(self::TITLE);
        $elementDTO->getDate()->willReturn(new DateTime('now'));

        $entityManager->persist(Argument::any())->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $this->handle($saveElementCommand);
    }
}
