<?php
namespace recyger\JIRARESTClient\services\auth\v1\session;

use recyger\JIRARESTClient\common\CookieAuthenticationRequestProcessor;
use recyger\JIRARESTClient\common\exception\RequestException;
use recyger\JIRARESTClient\common\Parental;
use recyger\JIRARESTClient\common\RequestBase;

class SessionResource extends Parental
{
    protected $_name = 'session';

    public function get() : SessionEntry
    {
        $request  = new RequestBase($this->getURL(), RequestBase::METHOD_GET);
        $response = $this->processRequest($request);
        return new SessionEntry($response);
    }

    public function login(string $username, string $password) : bool
    {
        $request = new RequestBase(
            $this->getURL(),
            RequestBase::METHOD_POST,
            ['username' => $username, 'password' => $password]
        );
        try {
            $this->processRequest($request);
            return true;
        } catch (RequestException $e) {
            var_dump($e->__toString());
            return false;
        }
    }

    public function logout() : bool
    {
        $request = new RequestBase($this->getURL(), RequestBase::METHOD_DELETE);
        try {
            $this->processRequest($request);
            return true;
        } catch (RequestException $e) {
            return false;
        }
    }
}
