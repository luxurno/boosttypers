<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Provider;

use App\Bundle\DownloadBundle\Converter\PhotoConverter;
use App\Bundle\DownloadBundle\Manipulator\PhotoManipulator;
use App\Bundle\DownloadBundle\Validator\PhotoProviderValidator;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class PhotoProvider
{
    /** @var PhotoConverter */
    private $photoConverter;
    
    /** @var PhotoManipulator */
    private $photoManipulator;
    
    /** @var PhotoProviderValidator */
    private $photoProviderValidator;
    
    public function __construct(
        PhotoConverter $photoConverter,
        PhotoManipulator $photoManipulator,
        PhotoProviderValidator $photoProviderValidator
    )
    {
        $this->photoConverter = $photoConverter;
        $this->photoManipulator = $photoManipulator;
        $this->photoProviderValidator = $photoProviderValidator;
    }
    
    /**
     * @param array  $photos
     * @param string $website
     * @return array
     */
    public function provide(array $photos, string $website): array
    {
        $array = [];
        foreach ($photos as $photo) {
            if ($this->photoProviderValidator->validate($photo)) {
                $href = $this->photoManipulator->manipulate($photo);
                $array[] = $this->photoConverter->convert($website, $href);
            }
        }
        
        return $array;
    }
}
