<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Link\Exception\InvalidStrategyException;
use App\Bundle\DownloadBundle\Generator\ElementGenerator;
use App\Bundle\DownloadBundle\Link\LinkContext;
use App\Bundle\DownloadBundle\Transformer\ContentTransformer;
use App\Bundle\DownloadBundle\Validator\ElementValidator;
use App\Bundle\DownloadBundle\ValueObject\DownloadValueObject;
use PHPHtmlParser\Dom;
use Throwable;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadService
{
    /** @var ContentTransformer */
    private $contentTransformer;
    
    /** @var ElementGenerator */
    private $elementGenerator;

    /** @var ElementValidator */
    private $elementValidator;

    /** @var LinkContext */
    private $linkContext;

    /**
     * @param ContentTransformer $contentTransformer
     * @param ElementGenerator   $elementGenerator
     * @param ElementValidator   $elementValidator
     * @param LinkContext        $linkContext
     */
    public function __construct(
        ContentTransformer $contentTransformer,
        ElementGenerator $elementGenerator,
        ElementValidator $elementValidator,
        LinkContext $linkContext
    )
    {
        $this->contentTransformer = $contentTransformer;
        $this->elementGenerator = $elementGenerator;
        $this->elementValidator = $elementValidator;
        $this->linkContext = $linkContext;
    }

    /**
     * @param DownloadValueObject $downloadValueObject
     * @throws InvalidStrategyException
     */
    public function download(DownloadValueObject $downloadValueObject): void
    {
        $links = $this->linkContext->handle(
            $downloadValueObject->getAddress(),
            $downloadValueObject->getCount()
        );

        $collection = $this->contentTransformer->transform($links);
        foreach ($collection->getIterator() as $elementDTO) {
            if ($this->elementValidator->validate($elementDTO)) {
                $this->elementGenerator->generate($elementDTO);
            }
        }
    }
}
