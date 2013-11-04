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

    public function getFile()
    {
        return $this->file;
    }

    public function getData()
    {
        return $this->data;
    }
    
    public function compile()
    {
        if (null !== $this->file) {
            $swiftAttachment = \Swift_Attachment::fromPath($this->file);
        } elseif (null !== $this->data) {
            $swiftAttachment = \Swift_Attachment::newInstance($this->data);
        } else {
            throw new \RuntimeException('You need to set data on the attached file');
        }
        
        if (null !== $this->filename) {
            $swiftAttachment->setFilename($this->filename);
        }

        if (null !== $this->mimeType) {
            $swiftAttachment->setContentType($this->mimeType);
        }

        return $swiftAttachment;
    }
}