<?php
namespace recyger\JIRARESTClient\common;

use Curl\Curl;

class XSRFRequestProcessor implements RequestProcessorInterface
{
    private $_value = null;

    public function afterRequest(Curl $curl)
    {
        $this->_value = $curl->getResponseCookie(RequestProcessorHelper::XSRF_COOKIE_NAME);
    }

    public function beforeRequest(Curl $curl)
    {
        if (!is_null($this->_value)) {
            $curl->setCookie(RequestProcessorHelper::XSRF_COOKIE_NAME, $this->_value);
        }
    }
}
