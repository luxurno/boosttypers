<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Converter\JavascriptTagConverter;
use App\Bundle\DownloadBundle\Converter\VideoConverter;
use App\Bundle\DownloadBundle\Service\JavascriptDownloadService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class JavascriptDownloadServiceSpec extends ObjectBehavior
{
    private const ADDRESS = 'http://www.watchthedeer.com/photos';
    private const WEBSITE = 'http://www.watchthedeer.com/photos/javascript:__doPostBack(&#39;btnDoes1016&#39;,&#39;&#39;)';
    private const TAG = 'btnDoes1016';
    private const HREF = 'Feeder.20161026_000838_1.mp4';

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(JavascriptDownloadService::class);
    }

    public function let(
        JavascriptTagConverter $javascriptTagConverter,
        VideoConverter $videoConverter,
        ContainerBagInterface $containerBag
    ): void
    {
        $this->beConstructedWith(
            $javascriptTagConverter,
            $videoConverter,
            $containerBag
        );
    }

    public function it_should_return_video_url(
        JavascriptTagConverter $javascriptTagConverter,
        ContainerBagInterface $containerBag,
        VideoConverter $videoConverter
    ): void
    {
        $javascriptTagConverter->convert(self::WEBSITE)->willReturn(self::TAG);
        $containerBag->get('download.address')->willReturn(self::ADDRESS);

        $videoConverter->convert(Argument::any(), self::HREF)->shouldBeCalled();
        $this->getVideo(self::WEBSITE);
    }
}
