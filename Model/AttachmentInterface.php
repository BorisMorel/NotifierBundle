<?php

namespace IMAG\NotifierBundle\Model;

interface AttachmentInterface
{
    public function setMimeType($mime);
    
    public function setFilename($filename);

    public function loadFile($file);

    public function setData($data);

    public function getMimeType();

    public function getFilename();

    public function getFile();

    public function getData();
}