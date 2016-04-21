<?php
namespace recyger\JIRARESTClient\common;

abstract class Magical extends \ArrayIterator
{
    public function __get($name)
    {
        if ($this->_isGettable($name)) {
            return call_user_func([$this, 'get' . $name]);
        }
        return $this[$name];
    }

    public function __set($name, $value)
    {
        if ($this->_isSettable($name)) {
            call_user_func([$this, 'get' . $name], $value);
        }
        $this[$name] = $value;
    }

    private function _isGettable($name)
    {
        return method_exists($this, 'get' . $name);
    }

    private function _isSettable($name)
    {
        return method_exists($this, 'set' . $name);
    }

    public function __unset($name)
    {
        if ($this->_isUnsettable($name)) {
            call_user_func([$this, 'unset' . $name]);
        }
        unset($this[$name]);
    }

    private function _isUnsettable($name)
    {
        return method_exists($this, 'unset' . $name);
    }

    public function __isset($name)
    {
        return $this->_isGettable($name) || isset($this[$name]);
    }
}
