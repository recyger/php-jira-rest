<?php
namespace recyger\JIRARESTClient\common;

abstract class Parental extends Magical implements NestingInterface
{
    protected $_name         = null;
    protected $_itemsClasses = [];

    private $_parent = null;

    public function __construct(NestingInterface $parent = null, string $name = null)
    {
        parent::__construct();
        if (!is_null($parent)) {
            $this->setParent($parent);
        }
        if (!is_null($name)) {
            $this->setName($name);
        }
    }

    public function __get($name)
    {
        if (!isset($this[$name]) && isset($this->_itemsClasses[$name])) {
            $this[$name] = $this->_initInstance($name);
        }
        return parent::__get($name);
    }

    private function _initInstance($name)
    {
        return new $this->_itemsClasses[$name]($this, $name);
    }

    public function getURL() : string
    {
        return $this->getParent()->getURL() . '/' . $this->getName();
    }

    public function getParent() : NestingInterface
    {
        return $this->_parent;
    }

    public function setParent(NestingInterface $parent)
    {
        $this->_parent = $parent;
    }

    public function getName() : string
    {
        return $this->_name;
    }

    public function setName(string $name)
    {
        $this->_name = $name;
    }

    public function processRequest(RequestBase $request) : array
    {
        return $this->getParent()->processRequest($request);
    }

    public function setProcessor(string $name, RequestProcessorInterface $processor)
    {
        $this->getParent()->setProcessor($name, $processor);
    }
}
