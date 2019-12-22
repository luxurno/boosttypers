<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Download;

use App\Bundle\DownloadBundle\Download\Exception\InvalidStrategyException;
use App\Bundle\DownloadBundle\Download\Strategy\DownloadStrategyInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadContext
{
    /** @var DownloadStrategyInterface[] */
    private $strategies = [];

    public function addStrategy(DownloadStrategyInterface $strategy): void
    {
        $this->strategies[] = $strategy;
    }

    /**
     * @param string $website
     * @return array
     * @throws InvalidStrategyException
     */
    public function handle(string $website): array
    {
        if (empty($this->strategies)) {
            throw new InvalidStrategyException();
        }

        foreach ($this->strategies as $strategy) {
            if ($strategy->isValid($website)) {
                return $strategy->getPhotos($website);
            }
        }

        return [];
    }
}
