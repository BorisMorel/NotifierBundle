<?php

namespace IMAG\NotifierBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('imag_notifier');
        $rootNode
            ->children()
                ->scalarNode('default_from')->defaultValue('fqdn@d.tld')->end()
                ->scalarNode('default_subject')->defaultValue('Default subject')->end()
                ->scalarNode('prefix_subject')->defaultValue('')->end()
            ->end()
            ;
            
        return $treeBuilder;
    }
}
