<?php
namespace recyger\JIRARESTClient\common;

use Curl\Curl;

interface RequestProcessorInterface
{
    public function beforeRequest(Curl $curl);

    public function afterRequest(Curl $curl);
}
