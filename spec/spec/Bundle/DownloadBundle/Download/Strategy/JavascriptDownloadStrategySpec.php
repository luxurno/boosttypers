<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Download\Strategy;

use App\Bundle\DownloadBundle\Download\Strategy\JavascriptDownloadStrategy;
use App\Bundle\DownloadBundle\Service\JavascriptDownloadService;
use PhpSpec\ObjectBehavior;

class JavascriptDownloadStrategySpec extends ObjectBehavior
{
    private const WEBSITE = 'http://www.watchthedeer.com/photos/javascript:__doPostBack(&#39;btnDoes1016&#39;,&#39;&#39;)';

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(JavascriptDownloadStrategy::class);
    }

    public function let(JavascriptDownloadService $javascriptDownloadService): void
    {
        $this->beConstructedWith($javascriptDownloadService);
    }

    public function it_should_call_get_video_from_javascript_service(JavascriptDownloadService $javascriptDownloadService): void
    {
        $javascriptDownloadService->getVideo(self::WEBSITE)->shouldBeCalled();

        $this->getPhotos(self::WEBSITE);
    }
}
