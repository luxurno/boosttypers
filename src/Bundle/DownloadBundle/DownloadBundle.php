<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }
}
