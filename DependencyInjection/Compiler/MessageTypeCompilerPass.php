<?php

namespace IMAG\NotifierBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class MessageTypeCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('imag_notifier.provider')) {
            return;
        }

        $definition = $container->getDefinition(
            'imag_notifier.provider'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'imag_notifier.manager'
        );
        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall(
                    'addManager',
                    array(new Reference($id), $attributes['alias'])
                );
            }
        }
    }
}