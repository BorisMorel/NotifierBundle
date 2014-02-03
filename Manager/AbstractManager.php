<?php

namespace IMAG\NotifierBundle\Manager;

use IMAG\NotifierBundle\Context\Context;

use IMAG\NotifierBundle\Model\MessageInterface;
use IMAG\NotifierBundle\Model\AttachmentInterface;
use IMAG\NotifierBundle\Model\Attachment;

abstract class AbstractManager implements ManagerInterface
{
    /**
     * @var \IMAG\NotifierBundle\Context\Context
     */
    protected $context;

    /**
     * @var array
     */
    protected $messages;

    /**
     * @param Context $context The mailer engine
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
        $this->messages = array();
    }

    public function createAttachment()
    {
        return new Attachment();
    }

    public function addMessage(MessageInterface $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    public function compile()
    {
        $res = array();

        foreach ($this->messages as $message) {
            $res[] = $this->compileOne($message);
        }

        return $res;
    }

    protected function CompileOne(MessageInterface $message)
    {
        $swMessage = \Swift_Message::newInstance()
            ->setFrom($message->getFrom())
            ->setTo($message->getTo())
            ->setCc($message->getCc())
            ->setBcc($message->getBcc())
            ->setSubject($message->getSubject())
            ->setBody($message->getBody())
            ;
        
        foreach ($message->getAttachments() as $attachment) {
            $swMessage->attach($this->compileAttachment($attachment));
        }

        return $swMessage;            
    }
    
    public function compileAttachment(AttachmentInterface $attachment)
    {
        if (null !== $attachment->getFile()) {
            $swiftAttachment = \Swift_Attachment::fromPath($attachment->getFile());
        } elseif (null !== $attachment->getData()) {
            $swiftAttachment = \Swift_Attachment::newInstance($attachment->getData());
        } else {
            throw new \RuntimeException('You need to set data on the attached file');
        }
        
        if (null !== $attachment->getFilename()) {
            $swiftAttachment->setFilename($attachment->getFilename());
        }

        if (null !== $attachment->getMimeType()) {
            $swiftAttachment->setContentType($attachment->getMimeType());
        }

        return $swiftAttachment;
    }
}