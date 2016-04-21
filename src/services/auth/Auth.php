<?php
namespace recyger\JIRARESTClient\services\auth;

use recyger\JIRARESTClient\common\Parental;
use recyger\JIRARESTClient\services\auth\v1\V1;

/**
 * Class Auth
 *
 * @property V1 v1
 * @property V1 latest
 *
 * @package recyger\JIRAREST\services\auth
 */
class Auth extends Parental
{
    protected $_itemsClasses = [
        'v1'     => V1::class,
        'latest' => V1::class,
    ];
}
