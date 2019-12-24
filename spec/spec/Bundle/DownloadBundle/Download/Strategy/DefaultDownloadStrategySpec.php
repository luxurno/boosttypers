<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Download\Strategy;

use App\Bundle\DownloadBundle\Collector\PhotoCollector;
use App\Bundle\DownloadBundle\Decoder\StringDecoder;
use App\Bundle\DownloadBundle\Download\Strategy\DefaultDownloadStrategy;
use App\Bundle\DownloadBundle\Provider\PhotoProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultDownloadStrategySpec extends ObjectBehavior
{
    private const WEBSITE = 'http://www.watchthedeer.com/looping_images/Sept-2016-Virginia%20Bucks/viewer';

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(DefaultDownloadStrategy::class);
    }

    public function let(
        PhotoCollector $photoCollector,
        PhotoProvider $photoProvider,
        StringDecoder $stringDecoder
    ): void
    {
        $this->beConstructedWith(
            $photoCollector,
            $photoProvider,
            $stringDecoder
        );
    }

    public function it_should_get_photos_hrefs(
        PhotoCollector $photoCollector,
        PhotoProvider $photoProvider,
        StringDecoder $stringDecoder
    ): void
    {
        $arrayPhotos = ['String-photos','long-from-script'];
        $stringDecoder->decode(Argument::any())->shouldBeCalled();
        $photoCollector->collect(Argument::any())->shouldBeCalled()->willReturn($arrayPhotos);
        $photoProvider->provide($arrayPhotos, self::WEBSITE)->shouldBeCalled();

        $this->getPhotos(self::WEBSITE);
    }
}
