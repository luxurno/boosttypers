<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Download\Strategy;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
interface DownloadStrategyInterface
{
    public function isValid(string $website): bool;
    public function getPhotos(string $website): array;
}