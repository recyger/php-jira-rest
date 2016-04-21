<?php


namespace recyger\JIRARESTClient\common;


class ServiceVersion extends Parental
{
    public function setName(string $name)
    {
        $name = $this->_normalizationName($name);
        parent::setName($name);
    }

    private function _normalizationName($name)
    {
        if ($name === 'latest') {
            return $name;
        }
        return substr($name, 1);
    }
}
