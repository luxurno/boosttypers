<?php

declare(strict_types = 1);

namespace spec\App\Bundle\DownloadBundle\Link;

use App\Bundle\DownloadBundle\Link\Exception\InvalidStrategyException;
use App\Bundle\DownloadBundle\Link\LinkContext;
use App\Bundle\DownloadBundle\Link\Strategy\LinkStrategyInterface;
use PhpSpec\ObjectBehavior;

class LinkContextSpec extends ObjectBehavior
{
    private const WEBSITE = 'http://www.watchthedeer.com/photos';
    private const COUNT = 20;

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(LinkContext::class);
    }

    public function it_should_not_call_getlinks_when_is_not_valid(LinkStrategyInterface $linkStrategy): void
    {
        $this->addStrategy($linkStrategy);

        $linkStrategy->isValid(self::WEBSITE)->willReturn(false);
        $linkStrategy->getLinks(self::WEBSITE, self::COUNT)->shouldNotBeCalled();

        $this->handle(self::WEBSITE, self::COUNT);
    }

    public function it_should_call_getlinks_when_is_valid(LinkStrategyInterface $linkStrategy): void
    {
        $this->addStrategy($linkStrategy);

        $linkStrategy->isValid(self::WEBSITE)->willReturn(true);
        $linkStrategy->getLinks(self::WEBSITE, self::COUNT)->shouldBeCalled();

        $this->handle(self::WEBSITE, self::COUNT);
    }

    public function it_should_throw_exception_when_containes_empty_strategies(LinkStrategyInterface $linkStrategy): void
    {
        $this->shouldThrow(InvalidStrategyException::class)->during('handle', [self::WEBSITE, self::COUNT]);
    }
}
