<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\ValueObject;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadValueObject
{
    /** @var string */
    private $address;

    /** @var int */
    private $count;

    public function __construct(string $address, int $count)
    {
        $this->address = $address;
        $this->count = $count;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
