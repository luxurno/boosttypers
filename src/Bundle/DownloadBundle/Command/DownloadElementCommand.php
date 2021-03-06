<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Command;

use App\Bundle\DownloadBundle\Service\DownloadService;
use App\Bundle\DownloadBundle\ValueObject\DownloadValueObject;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadElementCommand extends Command
{
    /** @var DownloadService */
    private $downloadService;

    /** @var ContainerBagInterface */
    private $containerBag;

    protected static $defaultName = 'app:download:element';

    public function __construct(
        DownloadService $downloadService,
        ContainerBagInterface $containerBag
    )
    {
        $this->downloadService = $downloadService;
        $this->containerBag = $containerBag;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Command for download Elements');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $output->writeln([
            'Downloading Elements Data',
            '==========================',
            'Processing...',
            '',
        ]);

        $downloadValueObject = new DownloadValueObject(
            $this->containerBag->get('download.address'),
            $this->containerBag->get('download.count')
        );

        $this->downloadService->download($downloadValueObject);

        $output->writeln([
            '==========================',
            'Elements has been downloaded successfully',
        ]);
    }
}