<?php

namespace IMAG\NotifierBundle\Model;

interface MessageInterface
{
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

    public function setSubject($subject);
    public function getSubject();

    public function setBody($body);
    public function getBody();

    public function addAttachment(Attachment $attachment);
    public function setAttachments(array $attachments);
    public function getAttachments();
}