<?php

namespace IMAG\NotifierBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use IMAG\NotifierBundle\DependencyInjection\Compiler\MessageTypeCompilerPass;

class IMAGNotifierBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MessageTypeCompilerPass());
    }
}
