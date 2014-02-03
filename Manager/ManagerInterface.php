<?php

namespace IMAG\NotifierBundle\Manager;

use IMAG\NotifierBundle\Model\MessageInterface;

interface ManagerInterface
{
    public function createMessage();
    public function createAttachment();    
    public function addMessage(MessageInterface $message);
    public function compile();
}