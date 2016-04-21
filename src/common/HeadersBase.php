<?php
namespace recyger\JIRARESTClient\common;

class HeadersBase extends Magical
{

    public function __construct(array $headers)
    {
        parent::__construct($headers);
    }

    public function offsetExists($name)
    {
        $name = $this->_processHeaderName($name);
        parent::offsetExists($name);
    }

    private function _processHeaderName(string $name)
    {
        if (preg_match('#[^\w\-]#', $name)) {
            throw new \UnexpectedValueException('The variable "$name" contains not supported characters.');
        }
        return $this->_normalizationHeaderName($name);
    }

    private function _normalizationHeaderName(string $name)
    {
        return implode('-', array_map('ucfirst', explode('-', $name)));
    }

    public function offsetGet($name)
    {
        $name = $this->_processHeaderName($name);
        parent::offsetGet($name);
    }

    public function offsetSet($name, $value)
    {
        $name = $this->_processHeaderName($name);
        parent::offsetSet($name, $value);
    }


}
