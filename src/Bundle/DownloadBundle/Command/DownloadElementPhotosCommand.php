<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Command;

use App\Bundle\DownloadBundle\Service\DownloadPhotoService;
use App\Bundle\DownloadBundle\ValueObject\DownloadValueObject;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadElementPhotosCommand extends Command
{
    /** @var DownloadPhotoService */
    private $downloadPhotoService;

    /** @var ContainerBagInterface */
    private $containerBag;

    protected static $defaultName = 'app:download:element-photos';

    public function __construct(
        DownloadPhotoService $downloadPhotoService,
        ContainerBagInterface $containerBag
    )
    {
        $this->downloadPhotoService = $downloadPhotoService;
        $this->containerBag = $containerBag;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Command for download Elements Photos');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Downloading Elements Photos Data',
            '==========================',
            'Processing...',
            ''
        ]);

        $downloadValueObject = new DownloadValueObject(
            $this->containerBag->get('download.address'),
            $this->containerBag->get('download.count')
        );

        $this->downloadPhotoService->downloadPhotos($downloadValueObject);

        $output->writeln([
            '==========================',
            'Elements Photos has been downloaded successfully',
        ]);
    }
}