<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\Entity\Element;
use App\Bundle\DownloadBundle\Factory\ElementFactory;
use App\Bundle\DownloadBundle\Factory\ElementFactoryInterface;
use PhpSpec\ObjectBehavior;

class ElementFactorySpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ElementFactory::class);
        $this->shouldImplement(ElementFactoryInterface::class);
    }

    public function it_should_create_new_element_entity(): void
    {
        $this->factory()->shouldBeAnInstanceOf(Element::class);
    }
}
