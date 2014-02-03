<?php

namespace IMAG\NotifierBundle\Manager;

use IMAG\NotifierBundle\Context\Context;

use IMAG\NotifierBundle\Model\MessageInterface;
use IMAG\NotifierBundle\Model\HtmlMessage;

class HtmlManager extends AbstractManager
{
    /**
     * @var \Symfony\Bundle\TwigBundle\TwigEngine
     */
    private $engine;

    public function __construct(Context $context, \Twig_Environment $engine)
    {
        parent::__construct($context);
        $this->engine = $engine;
    }

    public function createMessage()
    {
        $message = new HtmlMessage();
        $message
            ->setFrom($this->context->getDefaultFrom())
            ->setSubject($this->context->getDefaultSubject())
            ;

        return $message;
    }

    protected function compileOne(MessageInterface $message)
    {
        $tpl = $message->getTemplate();
        $template = $this->engine->loadTemplate($tpl['tpl']);

        $swMessage = parent::compileOne($message);

        $subject = $template->hasBlock($message->getSubjectBlock()) ? $template->renderBlock($message->getSubjectBlock(), $tpl['vars']) : $message->getSubject();
        $body = $template->hasBlock($message->getBodyBlock()) ? $template->renderBlock($message->getBodyBlock(), $tpl['vars']) : $message->getBody();
        
        $swMessage
            ->setSubject($subject)
            ->setBody($body, 'text/html')
            ;

        return $swMessage;
    }
}