<?php

namespace spec\App\Bundle\DownloadBundle\Link\Strategy;

use App\Bundle\DownloadBundle\Converter\DateConverter;
use App\Bundle\DownloadBundle\Decoder\StringDecoder;
use App\Bundle\DownloadBundle\Link\Strategy\DefaultLinkStrategy;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultLinkStrategySpec extends ObjectBehavior
{
    private const WEBSITE = 'http://www.watchthedeer.com/photos';
    private const COUNT = 20;

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(DefaultLinkStrategy::class);
    }

    public function let(
        DateConverter $dateConverter,
        StringDecoder $stringDecoder
    ): void
    {
        $this->beConstructedWith(
            $dateConverter,
            $stringDecoder
        );
    }

    public function it_should_create_array_with_elements(StringDecoder $stringDecoder): void
    {
        $stringDecoder->decode(Argument::any())->shouldBeCalled();
        $return = $this->getLinks(self::WEBSITE, self::COUNT);
        $return->shouldHaveCount(self::COUNT);
    }
}
