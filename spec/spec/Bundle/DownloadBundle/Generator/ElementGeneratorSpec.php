<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Generator;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Generator\ElementGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class ElementGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ElementGenerator::class);
    }

    public function let(CommandBus $commandBus): void
    {
        $this->beConstructedWith($commandBus);
    }

    public function it_should_call_handle_on_command_bus(
        CommandBus $commandBus,
        ElementDTO $elementDTO
    ): void
    {
        $commandBus->handle(Argument::any())->shouldBeCalled();
        $this->generate($elementDTO);
    }
}
