<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('download');

        $treeBuilder->getRootNode()
                ->children()
                    ->variableNode('address')->end()
                    ->variableNode('count')->end()
                ->end()
            ->end();
        ;

        return $treeBuilder;
    }
}
