<?php

namespace IMAG\NotifierBundle\Provider;

use Symfony\Bundle\TwigBundle\TwigEngine;

use IMAG\NotifierBundle\Context\Context;

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
    
    public function __construct(\Swift_mailer $mailer, TwigEngine $tplEngine, Context $context)
    {
        $this->tplEngine = $tplEngine;
        $this->mailer = $mailer;
        $this->context = $context;
    }

    public function createMessage()
    {
        $message = new BaseMessage();
        $message
            ->setFrom($this->context->getDefaultFrom())
            ->setSubject($this->context->getDefaultSubject())
            ;

        return $message;
    }

    public function createHtmlMessage()
    {
        $message = new HtmlMessage($this->tplEngine);
        $message
            ->setFrom($this->context->getDefaultFrom())
            ->setSubject($this->context->getDefaultSubject())
            ;

        return $message;
    }

    public function send(MessageInterface $message)
    {
        $this->prepare($message);
        $this->mailer->send($message->compile());
    }

    private function prepare(MessageInterface $message)
    {
        $message->setSubject(
            $this->context->getPrefixSubject()
            .$message->getSubject()
        );
    }
}

