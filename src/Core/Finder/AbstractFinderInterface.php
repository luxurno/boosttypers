<?php

declare(strict_types = 1);

namespace App\Core\Finder;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
interface AbstractFinderInterface
{
    public function getTableName(): string;
    public function getAlias(): string;
}
