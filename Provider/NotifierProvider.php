<?php

namespace IMAG\NotifierBundle\Provider;

use Symfony\Bundle\TwigBundle\TwigEngine;

use IMAG\NotifierBundle\Model\MessageInterface,
    IMAG\NotifierBundle\Model\BaseMessage,
    IMAG\NotifierBundle\Model\HtmlMessage
    ;

class NotifierProvider
{
    private
        $tplEngine,
        $mailer,
        $context
        ;
    
    public function __construct(\Swift_mailer $mailer, TwigEngine $tplEngine, $context = null)
    {
        $this->tplEngine = $tplEngine;
        $this->mailer = $mailer;
        $this->context = $context;
    }

    public function createMessage()
    {
        $message = new BaseMessage();
        //        $message->setFrom($context->getFrom());
        $message->setFrom('toto@toto.fr');

        return $message;
    }

    public function createHtmlMessage()
    {
        $message = new HtmlMessage($this->tplEngine);
        //        $message->setFrom($context->getFrom());
        $message->setFrom('toto@toto.fr');

        return $message;
    }

    public function send(MessageInterface $message)
    {
        $this->mailer->send($message->compile());
    }
}

