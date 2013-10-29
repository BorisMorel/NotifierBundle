<?php

namespace IMAG\NotifierBundle\Model;

class BaseMessage implements MessageInterface
{
    private
        $param
        ;

    public function setFrom($from)
    {
        $this->params['from'] = $from;

        return $this;
    }

    public function getFrom()
    {
        return isset($this->params['from']) ? $this->params['from'] : null;
    }

    public function addTo($to, $address = null)
    {
        if (null === $address) {
            $address = $to;
        }

        $this->params['to'][$address] = $to;

        return $this;
    }

    public function removeTo($to, $address = null)
    {
        if (null === $address) {
            $address = $to;
        }

        unset($this->params['to'][$address]);

        return $this;
    }

    public function setTo(array $to)
    {
        foreach ($to as $entity) {
            $this->addTo($entity);
        }

        return $this;
    }
    
    public function getTo()
    {
        return isset($this->params['to']) ? $this->params['to'] : null;
    }

    public function addCc($cc, $address = null)
    {
        if (null === $address) {
            $address = $cc;
        }

        $this->params['cc'][$key] = $cc;

        return $this;
    }

    public function removeCc($cc, $address = null)
    {
        if (null === $address) {
            $address = $cc;
        }

        unset($this->params['cc'][$key]);

        return $this;
    }

    public function setCc(array $cc)
    {
        foreach ($cc as $entity) {
            $this->addCc($entity);
        }

        return $this;
    }
    
    public function getCc()
    {
        return isset($this->params['cc']) ? $this->params['cc'] : null;
    }

    public function addBcc($bcc, $address = null)
    {
        if (null === $address) {
            $address = $bcc;
        }

        $this->params['bcc'][$key] = $bcc;

        return $this;
    }

    public function removeBcc($bcc, $address = null)
    {
        if (null === $address) {
            $address = $bcc;
        }

        unset($this->params['bcc'][$key]);

        return $this;
    }

    public function setBcc(array $bcc)
    {
        foreach ($bcc as $entity) {
            $this->addBcc($entity);
        }

        return $this;
    }
    
    public function getBcc()
    {
        return isset($this->params['bcc']) ? $this->params['bcc'] : null;
    }

    public function setSubject($subject)
    {
        $this->params['subject'] = $subject;

        return $this;
    }

    public function getSubject()
    {
        return isset($this->params['subject']) ? $this->params['subject'] : null;
    }

    public function setBody($body)
    {
        $this->params['body'] = $body;

        return $this;
    }

    public function getBody()
    {
        return isset($this->params['body']) ? $this->params['body'] : null;
    }

    public function compile()
    {
        $message = \Swift_Message::newInstance()
            ->setFrom($this->getFrom())
            ->setTo($this->getTo())
            ->setCc($this->getCc())
            ->setBcc($this->getBcc())
            ->setSubject($this->getSubject())
            ->setBody($this->getBody())
            ;

        return $message;
    }

}