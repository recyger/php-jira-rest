<?php
namespace recyger\JIRARESTClient;

use recyger\JIRARESTClient\common\authentivation\HTTPBasicAuthenticationRequestProcessor;
use recyger\JIRARESTClient\common\ConnectBase;
use recyger\JIRARESTClient\common\RequestProcessorHelper;
use recyger\JIRARESTClient\services\api\API;
use recyger\JIRARESTClient\services\auth\Auth;

/**
 * Class JIRA
 *
 * @property API  api
 * @property Auth auth
 *
 * @package recyger\JIRARESTClient
 */
class JIRA extends ConnectBase
{
    protected $_itemsClasses = [
        'api'  => API::class,
        'auth' => Auth::class,
    ];

    public function __construct($host, string $username = null, string $password = null)
    {
        parent::__construct($host);
        if (!is_null($username) && !is_null($password)) {
            $this->setProcessor(
                RequestProcessorHelper::AUTHENTICATION,
                new HTTPBasicAuthenticationRequestProcessor($username, $password)
            );
        }
    }
}
