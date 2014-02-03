<?php

namespace IMAG\NotifierBundle\Provider;

use Symfony\Bundle\TwigBundle\TwigEngine;

use IMAG\NotifierBundle\Context\Context;
use IMAG\NotifierBundle\Manager\ManagerInterface;

/**
 * Main class to manage the notifier system
 *
 * @author Boris Morel <boris.morel@imag.fr>
 */
class NotifierProvider
{
    /**
     * @var \Swift_mailer
     */
    private $mailer;

    /**
     * @var array
     */
    private $types;

    public function __construct(\Swift_mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->types = array();
    }

    public function addManager(ManagerInterface $manager, $alias)
    {
        $this->types[$alias] = $manager;
    }

    public function getManager($alias)
    {
        if (true === array_key_exists($alias, $this->types)) {
            return $this->types[$alias];
        }

        return;
    }

    public function send(ManagerInterface $manager)
    {
        foreach ($manager->compile() as $message) {
            $this->mailer->send($message);
        }

        $manager->clear();
    }
}

