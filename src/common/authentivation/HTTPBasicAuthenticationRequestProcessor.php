<?php
namespace recyger\JIRARESTClient\common\authentivation;

use Curl\Curl;
use recyger\JIRARESTClient\common\RequestProcessorInterface;

class HTTPBasicAuthenticationRequestProcessor implements RequestProcessorInterface
{
    private $_username = null;
    private $_password = null;

    public function __construct(string $username, string $password)
    {
        $this->_username = $username;
        $this->_password = $password;
    }

    public function afterRequest(Curl $curl)
    {
        // Nothing to do
    }

    public function beforeRequest(Curl $curl)
    {
        $curl->setOpt(CURLOPT_USERPWD, sprintf('%s:%s', $this->_username, $this->_password));
    }
}
