<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Download;

use App\Bundle\DownloadBundle\Download\DownloadContext;
use App\Bundle\DownloadBundle\Download\Exception\InvalidStrategyException;
use App\Bundle\DownloadBundle\Download\Strategy\DownloadStrategyInterface;
use PhpSpec\ObjectBehavior;

class DownloadContextSpec extends ObjectBehavior
{
    private const WEBSITE = 'http://www.watchthedeer.com/looping_images/June_2018_Fawn/viewer.aspx';

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(DownloadContext::class);
    }

    public function it_should_not_call_getphotos_when_is_not_valid(DownloadStrategyInterface $downloadStrategy): void
    {
        $this->addStrategy($downloadStrategy);

        $downloadStrategy->isValid(self::WEBSITE)->willReturn(false);
        $downloadStrategy->getPhotos(self::WEBSITE)->shouldNotBeCalled();

        $this->handle(self::WEBSITE);
    }

    public function it_should_call_getphotos_when_is_valid(DownloadStrategyInterface $downloadStrategy): void
    {
        $this->addStrategy($downloadStrategy);

        $downloadStrategy->isValid(self::WEBSITE)->willReturn(true);
        $downloadStrategy->getPhotos(self::WEBSITE)->shouldBeCalled();

        $this->handle(self::WEBSITE);
    }

    public function it_should_throw_exception_when_containes_empty_strategies(DownloadStrategyInterface $downloadStrategy): void
    {
        $this->shouldThrow(InvalidStrategyException::class)->during('handle', [self::WEBSITE]);
    }
}
