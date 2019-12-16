<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Collection;

use ArrayIterator;
use Countable;
use App\Bundle\DownloadBundle\DTO\ElementPhotoDTO;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementPhotoDTOCollection implements Countable
{
    /** @var ElementDTO[] */
    private $array;
    
    public function __construct(ElementPhotoDTO ... $elementPhotoDTO)
    {
        $this->array = $elementPhotoDTO;
    }
    
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->array);
    }
    
    public function count(): int
    {
        return count($this->array);
    }
}
