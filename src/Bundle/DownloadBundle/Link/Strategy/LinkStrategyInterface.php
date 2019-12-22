<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Link\Strategy;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
interface LinkStrategyInterface
{
    public function isValid(string $website): bool;
    public function getLinks(string $website, int $count): array;
}