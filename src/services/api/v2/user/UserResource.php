<?php
namespace recyger\JIRARESTClient\services\api\v2\user;

use recyger\JIRARESTClient\common\Parental;
use recyger\JIRARESTClient\common\RequestBase;

class UserResource extends Parental
{
    protected $_name = 'user';

    public function get(string $username = null, string $key = null) : UserEntry
    {
        $request  = new RequestBase(
            $this->getURL(),
            RequestBase::METHOD_GET,
            [
                'username' => $username,
                'key'      => $key,
            ]
        );
        $response = $this->processRequest($request);
        return new UserEntry($response);
    }
}
