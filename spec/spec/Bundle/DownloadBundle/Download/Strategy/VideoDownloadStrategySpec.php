<?php

namespace spec\App\Bundle\DownloadBundle\Download\Strategy;

use App\Bundle\DownloadBundle\Download\Strategy\VideoDownloadStrategy;
use PhpSpec\ObjectBehavior;

class VideoDownloadStrategySpec extends ObjectBehavior
{
    private const VIDEO = 'http://www.watchthedeer.com/somevideo.mov';

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(VideoDownloadStrategy::class);
    }

    public function it_return_array_from_provided_photo(): void
    {
        $this->getPhotos(self::VIDEO)->shouldBeArray();
    }
}
