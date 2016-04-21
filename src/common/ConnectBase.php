<?php
namespace recyger\JIRARESTClient\common;

use Curl\Curl;
use recyger\JIRARESTClient\common\authentivation\CookieAuthenticationRequestProcessor;
use recyger\JIRARESTClient\common\exception\RequestException;

class ConnectBase extends Parental
{
    private $_host;
    private $_processors = [];

    public function __construct(string $host)
    {
        $this->setHost($host);
        $this->setProcessor(RequestProcessorHelper::XSRF, new XSRFRequestProcessor());
        if (!isset($this->_processors[RequestProcessorHelper::AUTHENTICATION])) {
            $this->setProcessor(RequestProcessorHelper::AUTHENTICATION, new CookieAuthenticationRequestProcessor());
        }
        parent::__construct();
    }

    public function setProcessor(string $name, RequestProcessorInterface $processor)
    {
        $this->_processors[$name] = $processor;
    }

    public function delProcessor(string $name)
    {
        unset($this->_processors[$name]);
    }

    public function getURL() : string
    {
        return $this->getHost() . '/rest';
    }

    public function getHost() : string
    {
        return $this->_host;
    }

    public function processRequest(RequestBase $request) : array
    {
        $curl = new Curl();
        $this->_beforeRequest($curl);

        foreach ($request->getHeaders() as $name => $value) {
            $curl->setHeader($name, $value);
        }

        foreach ($request->getCookies() as $name => $value) {
            $curl->setCookie($name, $value);
        }

        $method = $request->getMethod();
        if (!method_exists($curl, $method)) {
            throw new \BadMethodCallException();
        }
        $curl->$method($request->getUrl(), $request->getParameters());

        if ($curl->error) {
            throw new RequestException($curl->errorMessage, $curl->errorCode);
        }

        $this->_afterRequest($curl);

        $headers = [];
        foreach ($curl->responseHeaders as $name => $value) {
            $headers[$name] = $value;
        }

        $result = (array)$curl->response;
        $curl->close();

        return $result;
    }

    private function _beforeRequest($curl)
    {
        foreach ($this->_processors as $processor) {
            if ($processor instanceof RequestProcessorInterface) {
                $processor->beforeRequest($curl);
            }
        }
    }

    private function _afterRequest($curl)
    {
        foreach ($this->_processors as $processor) {
            if ($processor instanceof RequestProcessorInterface) {
                $processor->afterRequest($curl);
            }
        }
    }

    public function setHost(string $host)
    {
        $this->_host = rtrim($host, '/');
    }
}
