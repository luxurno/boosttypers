<?php

namespace spec\App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\DTO\ElementPhotoDTO;
use App\Bundle\DownloadBundle\Factory\ElementPhotoDTOFactory;
use App\Bundle\DownloadBundle\Factory\ElementPhotoDTOFactoryInterface;
use PhpSpec\ObjectBehavior;

class ElementPhotoDTOFactorySpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ElementPhotoDTOFactory::class);
        $this->shouldImplement(ElementPhotoDTOFactoryInterface::class);
    }

    public function it_should_return_new_elementPhotoDTO(): void
    {
        $this->factory()->shouldBeAnInstanceOf(ElementPhotoDTO::class);
    }

}
