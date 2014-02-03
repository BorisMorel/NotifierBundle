<?php

namespace IMAG\NotifierBundle\Manager;

use IMAG\NotifierBundle\Model\MessageInterface;
use IMAG\NotifierBundle\Model\BaseMessage;

class BaseManager extends AbstractManager
{
    public function createMessage()
    {
        $message = new BaseMessage();
        $message
            ->setFrom($this->context->getDefaultFrom())
            ->setSubject($this->context->getDefaultSubject())
            ;

        return $message;
    }
}