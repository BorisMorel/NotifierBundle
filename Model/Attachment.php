<?php

namespace IMAG\NotifierBundle\Model;

class Attachment implements AttachmentInterface
{
    private
        $mimeType,
        $filename,
        $file,
        $data
        ;

    public function setMimeType($mt)
    {
        $this->mimeType = $mt;

        return $this;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    public function loadFile($file)
    {
        $this->file = $file;

        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getMimeType()
    {
        return $this->mimeType;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getData()
    {
        return $this->data;
    }
}