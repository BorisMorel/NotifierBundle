<?php

namespace IMAG\NotifierBundle\Model;

use Symfony\Bundle\TwigBundle\TwigEngine;

class HtmlMessage extends BaseMessage
{
    private
        $tplEngine,
        $tpl
        ;

    public function __construct(TwigEngine $tplEngine)
    {
        $this->tplEngine = $tplEngine;
    }

    public function setTemplate($tpl, array $vars = array())
    {
        if (!$this->tplEngine->exists($tpl)) {
            throw new \RuntimeException(sprintf('Template "%s" does not exist', $tpl));
        }
        
        $this->tpl = array(
            'tpl' => $tpl,
            'vars' => $vars,
        );

        return $this;
    }

    public function compile()
    {
        $message = parent::compile();
        $message->setBody(
            $this->tplEngine->render($this->tpl['tpl'], array('data' => $this->tpl['vars'])),
            'text/html'
        );

        return $message;
    }
}