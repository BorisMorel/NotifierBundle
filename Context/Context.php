<?php

namespace IMAG\NotifierBundle\Context;

class Context
{
    private
        $config = array()
        ;
    
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getDefaultFrom()
    {
        return $this->config['default_from'];
    }

    public function getDefaultSubject()
    {
        return $this->config['default_subject'];
    }

    public function getPrefixSubject()
    {
        return $this->config['prefix_subject'];
    }
}