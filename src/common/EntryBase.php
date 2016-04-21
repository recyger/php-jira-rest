<?php
namespace recyger\JIRARESTClient\common;

use recyger\JIRARESTClient\common\exception\NoSuchAttributeException;

class EntryBase extends Magical
{
    protected $_fieldsName = [];

    public function offsetExists($name)
    {
        return in_array($name, $this->_fieldsName);
    }

    public function offsetGet($name)
    {
        $this->_checkAttribute($name);
        return parent::offsetGet($name);
    }

    private function _checkAttribute($name)
    {
        if (!in_array($name, $this->_fieldsName)) {
            throw new NoSuchAttributeException();
        }
    }

    public function offsetSet($name, $value)
    {
        $this->_checkAttribute($name);
        parent::offsetSet($name, $value);
    }

    public function offsetUnset($name)
    {
        $this->_checkAttribute($name);
        parent::offsetUnset($name);
    }

    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $name => $value) {
            if (isset($this->$name)) {
                $this->$name = $value;
            }
        }
    }
}
