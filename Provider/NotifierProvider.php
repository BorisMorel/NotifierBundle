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
    
    public function __construct(\Swift_mailer $mailer, Context $context)
    {
        $this->mailer = $mailer;
        $this->context = $context;
    }

    public function setTwigEngine(TwigEngine $tplEngine = null)
    {
        $this->tplEngine = $tplEngine;

        return $this;
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
        if (null === $this->tplEngine) {
            throw new \InvalidArgumentException('Html engine is required to create html message');
        }

        $message = new HtmlMessage($this->tplEngine);
        $message
            ->setFrom($this->context->getDefaultFrom())
            ->setSubject($this->context->getDefaultSubject())
            ;

        return $message;
    }

    public function send(MessageInterface $message)
    {
        if (empty($message->getTo())
            && empty($message->getCc())
            && empty($message->getBcc())
        ) {
            throw new \RuntimeException('You must set at least one recipient');
        }
        
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

