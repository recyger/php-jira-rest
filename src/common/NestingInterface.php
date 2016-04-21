<?php
namespace recyger\JIRARESTClient\common;

interface NestingInterface
{
    public function getURL() : string;

    public function processRequest(RequestBase $request) : array;

    public function setProcessor(string $name, RequestProcessorInterface $processor);
}
