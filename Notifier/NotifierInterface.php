<?php

namespace IMAG\NotifierBundle\Notifier;

interface NotifierInterface
{
    public function __construct(\Swift_mailer $mailer, Context $context);

    public function setSubject($subject);

    public function getSubject();

    public function setFrom($from);

    public function getFrom();
    
    public function addTo($to);

    public function removeTo($to);

    public function setTo(array $to);
    
    public function getTo();

    public function addCc($cc);

    public function removeCc($cc);

    public function setCc(array $cc);

    public function getCc();

    public function addBcc($bcc);

    public function removeBcc($bcc);

    public function setBcc(array $bcc);

    public function getBcc();

    /* public function addAttachment($entity); */

    /* public function removeAttachment($entity); */

    /* public function setAttachment(array $entities); */

    /* public function getAttachment(); */

    public function send();
}