<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Validator;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Repository\ElementRepository;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementValidator
{
    /** @var ElementRepository */
    private $elementRepository;
    
    public function __construct(ElementRepository $elementRepository)
    {
        $this->elementRepository = $elementRepository;
    }
    
    /**
     * @param array $element
     * 
     * @return bool
     */
    public function validate(ElementDTO $elementDTO): bool
    {
        if (empty($elementDTO->getTitle())) {
            return false;
        }
        if (empty($elementDTO->getLink())) {
            return false;
        }
        if (false === $this->elementRepository->exist(['link' => $elementDTO->getLink()])) {
            return true;
        }
        
        return false;
    }
}
