<?php
namespace recyger\JIRARESTClient\common;

class RequestProcessorHelper
{
    const AUTHENTICATION = 'authentication';
    const XSRF           = 'xsrf';

    const SESSION_COOKIE_NAME = 'JSESSIONID';
    const XSRF_COOKIE_NAME    = 'atlassian.xsrf.token';
}
