<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle;

use App\Bundle\DownloadBundle\DependencyInjection\Compiler\DownloadCompilerPass;
use App\Bundle\DownloadBundle\DependencyInjection\Compiler\LinkCompilerPass;
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
        
        $container->addCompilerPass(new DownloadCompilerPass());
        $container->addCompilerPass(new LinkCompilerPass());
    }
}
