<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Provider;

use App\Bundle\DownloadBundle\Converter\PhotoConverter;
use App\Bundle\DownloadBundle\Manipulator\PhotoManipulator;
use App\Bundle\DownloadBundle\Provider\PhotoProvider;
use App\Bundle\DownloadBundle\Validator\PhotoProviderValidator;
use PhpSpec\ObjectBehavior;

class PhotoProviderSpec extends ObjectBehavior
{
    private const WEBSITE = 'http://www.watchthedeer.com';

    public function it_is_initializable()
    {
        $this->shouldHaveType(PhotoProvider::class);
    }

    public function let(
        PhotoConverter $photoConverter,
        PhotoManipulator $photoManipulator,
        PhotoProviderValidator $photoProviderValidator
    ): void
    {
        $this->beConstructedWith(
            $photoConverter,
            $photoManipulator,
            $photoProviderValidator
        );
    }

    public function it_should_not_collect_data_when_photo_is_not_validated(
        PhotoConverter $photoConverter,
        PhotoManipulator $photoManipulator,
        PhotoProviderValidator $photoProviderValidator
    ): void
    {
        $photos = ['http://some-address-to-photo/address-photo.jpg'];
        $href = 'address-photo.jpg';
        $photoProviderValidator->validate($photos[0])->willReturn(false);
        $photoManipulator->manipulate($photos[0])->willReturn($href)->shouldNotBeCalled();
        $photoConverter->convert(self::WEBSITE, $href)->shouldNotBeCalled();

        $this->provide($photos, self::WEBSITE);
    }

    public function it_should_collect_data_when_photo_is_validated(
        PhotoConverter $photoConverter,
        PhotoManipulator $photoManipulator,
        PhotoProviderValidator $photoProviderValidator
    ): void
    {
        $photos = ['http://some-address-to-photo/address-photo.jpg'];
        $href = 'address-photo.jpg';
        $photoProviderValidator->validate($photos[0])->willReturn(true);
        $photoManipulator->manipulate($photos[0])->willReturn($href)->shouldBeCalled();
        $photoConverter->convert(self::WEBSITE, $href)->shouldBeCalled();

        $this->provide($photos, self::WEBSITE);
    }
}
