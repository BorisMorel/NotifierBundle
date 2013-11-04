<?php

namespace IMAG\NotifierBundle\Provider;

use Symfony\Bundle\TwigBundle\TwigEngine;

use IMAG\NotifierBundle\Context\Context;

use IMAG\NotifierBundle\Model\MessageInterface,
    IMAG\NotifierBundle\Model\BaseMessage,
    IMAG\NotifierBundle\Model\HtmlMessage,
    IMAG\NotifierBundle\Model\Attachment    
    ;

/**
 * Main class to manage the notifier system
 *
 * @author Boris Morel <boris.morel@imag.fr>
 */
class NotifierProvider
{
    private
        $tplEngine,
        $mailer,
        $context
        ;
    
    /**
     * @param Swift_mailer \$mailer The mailer engine
     * @param Context $context The mailer engine
     */
    public function __construct(\Swift_mailer $mailer, Context $context)
    {
        $this->mailer = $mailer;
        $this->context = $context;
    }

    /**
     * @param TwigEngine $tplEngine Set the html engine
     *
     * @return NotifierProvider
     */
    public function setTwigEngine(TwigEngine $tplEngine = null)
    {
        $this->tplEngine = $tplEngine;

        return $this;
    }

    /**
     * Create a instance of basic message
     *
     * @return BaseMessage
     */    
    public function createMessage()
    {
        $message = new BaseMessage();
        $message
            ->setFrom($this->context->getDefaultFrom())
            ->setSubject($this->context->getDefaultSubject())
            ;

        return $message;
    }

    /**
     * Create a instance of html message
     *
     * @return HtmlMessage
     */
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

    /**
     * Create a instance of attachment
     *
     * @return Attachment
     */
    public function createAttachment()
    {
        return new Attachment();
    }
    

    /**
     * Method triggered to sent the message
     *
     * @param MessageInterface $message Instance of message
     *
     * @return bool
     */
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

