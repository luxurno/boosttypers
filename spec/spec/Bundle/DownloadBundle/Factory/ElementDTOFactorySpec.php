<?php

namespace spec\App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Factory\ElementDTOFactory;
use App\Bundle\DownloadBundle\Factory\ElementDTOFactoryInterface;
use PhpSpec\ObjectBehavior;

class ElementDTOFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(ElementDTOFactory::class);
        $this->shouldImplement(ElementDTOFactoryInterface::class);
    }

    public function it_should_create_new_elementDTO(): void
    {
        $this->factory()->shouldBeAnInstanceOf(ElementDTO::class);
    }
}
