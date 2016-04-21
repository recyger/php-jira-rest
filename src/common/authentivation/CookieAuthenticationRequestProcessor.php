<?php
namespace recyger\JIRARESTClient\common\authentivation;

use Curl\Curl;
use recyger\JIRARESTClient\common\RequestProcessorHelper;
use recyger\JIRARESTClient\common\RequestProcessorInterface;

class CookieAuthenticationRequestProcessor implements RequestProcessorInterface
{
    private $_value = null;

    public function __construct(string $value = null)
    {
        $this->_value = $value;
    }

    public function afterRequest(Curl $curl)
    {
        $this->_value = $curl->getResponseCookie(RequestProcessorHelper::SESSION_COOKIE_NAME);
    }

    public function beforeRequest(Curl $curl)
    {
        if (!is_null($this->_value)) {
            $curl->setCookie(RequestProcessorHelper::SESSION_COOKIE_NAME, $this->_value);
        }
    }
}
