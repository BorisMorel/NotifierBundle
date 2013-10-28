<?php

namespace IMAG\NotifierBundle\Notifier;

class Html implements NotifierInterface
{
    private 
        $mailer,
        $templating,
        $params
        ;
    
    public function __construct(\Swift_mailer $mailer, Context $context)
    {
        $this->params = array();

        $this->mailer = $mailer;
        $this->params['context'] = $context;
    }

    public function setTemplating(TwigEngine $templating)
    {
        $this->templating = $templating;
    }

    public function setSubject($subject)
    {
        $this->params['subject'] = $subject;

        return $this;
    }

    public function getSubject()
    {
        return $this->params['subject'];
    }

    public function setFrom($from)
    {
        $this->params['from'] = $from;

        return $this;
    }

    public function getFrom()
    {
        return $this->params['from'];
    }

    public function addTo($to)
    {
        $key = $this->hash($to);
        $this->params['to'][$key] = $to;

        return $this;
    }

    public function removeTo($to)
    {
        $key = $this->hash($to);
        unset($this->params['to'][$key]);

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
        return $this->params['to'];
    }

    public function addCc($cc)
    {
        $key = $this->hash($cc);
        $this->params['cc'][$key] = $cc;

        return $this;
    }

    public function removeCc($cc)
    {
        $key = $this->hash($cc);
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
        return $this->params['cc'];
    }

    public function addBcc($bcc)
    {
        $key = $this->hash($bcc);
        $this->params['bcc'][$key] = $bcc;

        return $this;
    }

    public function removeBcc($bcc)
    {
        $key = $this->hash($bcc);
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
        return $this->params['bcc'];
    }

    public function send()
    {

    }

    public function setTemplate($template)
    {
        $this->params['tpl'] = $template;

        return $this;
    }

    private function hash($key)
    {
        if (is_object($key)) { 
            throw new \RuntimeException('Object is not allowed');
        }

        return md5(serialize($key));
    }
}