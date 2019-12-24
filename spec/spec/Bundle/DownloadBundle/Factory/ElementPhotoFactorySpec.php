<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\Entity\ElementPhoto;
use App\Bundle\DownloadBundle\Factory\ElementPhotoFactory;
use App\Bundle\DownloadBundle\Factory\ElementPhotoFactoryInterface;
use PhpSpec\ObjectBehavior;

class ElementPhotoFactorySpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ElementPhotoFactory::class);
        $this->shouldImplement(ElementPhotoFactoryInterface::class);
    }

    public function it_should_create_new_element_photo_entity(): void
    {
        $this->factory()->shouldBeAnInstanceOf(ElementPhoto::class);
    }
}
