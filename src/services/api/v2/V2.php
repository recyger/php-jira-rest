<?php
namespace recyger\JIRARESTClient\services\api\v2;

use recyger\JIRARESTClient\common\ServiceVersion;
use recyger\JIRARESTClient\services\api\v2\myself\MyselfResource;
use recyger\JIRARESTClient\services\api\v2\user\UserResource;

/**
 * Class V2
 *
 * @property MyselfResource myself
 * @property UserResource   user
 *
 * @package recyger\JIRAREST\services\api\v2
 */
class V2 extends ServiceVersion
{
    protected $_itemsClasses = [
        'myself' => MyselfResource::class,
        'user'   => UserResource::class,
    ];
}
