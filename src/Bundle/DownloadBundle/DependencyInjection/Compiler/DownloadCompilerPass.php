<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        $contextDefinition = $container->findDefinition('App\Bundle\DownloadBundle\Download\DownloadContext');

        $strategyServiceIds = array_keys(
            $container->findTaggedServiceIds('download_strategy')
        );

        foreach ($strategyServiceIds as $strategyServiceId) {
            $contextDefinition->addMethodCall(
                'addStrategy',
                [new Reference($strategyServiceId)]
            );
        }
    }
}
