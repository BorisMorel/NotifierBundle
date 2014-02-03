<?php

namespace IMAG\NotifierBundle\Model;

class HtmlMessage extends BaseMessage
{
    private 
        $tpl,
        $subjectBlock,
        $bodyBlock
        ;

    public function setTemplate($tpl, array $vars = array())
    {
        $this->tpl = array(
            'tpl' => $tpl,
            'vars' => $vars,
        );

        return $this;
    }

    public function getTemplate()
    {
        return $this->tpl;
    }

    public function setSubjectBlock($block)
    {
        $this->subjectBlock = $block;

        return $this;
    }

    public function getSubjectBlock()
    {
        return null === $this->subjectBlock ? 'imagNotifierSubject' : $this->subjectBlock;
    }

    public function setBodyBlock($block)
    {
        $this->bodyBlock = $block;

        return $this;
    }

    public function getBodyBlock()
    {
        return null === $this->bodyBlock ? 'imagNotifierBody' : $this->bodyBlock;
    }
}