<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Collection;

use ArrayIterator;
use App\Bundle\DownloadBundle\DTO\ElementDTO;
use IteratorAggregate;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementDTOCollection implements IteratorAggregate
{
    /** @var ElementDTO[] */
    private $array;
    
    public function __construct(ElementDTO ... $elementDTO)
    {
        $this->array = $elementDTO;
    }
    
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->array);
    }
}
