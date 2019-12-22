<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Link;

use App\Bundle\DownloadBundle\Link\Exception\InvalidStrategyException;
use App\Bundle\DownloadBundle\Link\Strategy\LinkStrategyInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class LinkContext
{
    /** @var LinkStrategyInterface[] */
    private $strategies = [];

    public function addStrategy(LinkStrategyInterface $strategy): void
    {
        $this->strategies[] = $strategy;
    }

    /**
     * @param string $website
     * @return array
     * @throws InvalidStrategyException
     */
    public function handle(string $website, int $count): array
    {
        if (empty($this->strategies)) {
            throw new InvalidStrategyException();
        }

        foreach ($this->strategies as $strategy) {
            if ($strategy->isValid($website)) {
                return $strategy->getLinks($website, $count);
            }
        }

        return [];
    }
}