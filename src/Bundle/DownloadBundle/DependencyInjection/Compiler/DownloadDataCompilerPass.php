<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadDataCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('App\Bundle\DownloadBundle\Service\DownloadService')) {
            return;
        }
        $download = $container->getDefinition('App\Bundle\DownloadBundle\Service\DownloadService')->setPublic(true);
        
        
    }
    
    
}
