<?php
namespace recyger\JIRARESTClient\services\auth\v1;

use recyger\JIRARESTClient\common\ServiceVersion;
use recyger\JIRARESTClient\services\auth\v1\session\SessionResource;

/**
 * Class V1
 *
 * @property SessionResource session
 *
 * @package recyger\JIRAREST\services\auth\v1
 */
class V1 extends ServiceVersion
{
    protected $_itemsClasses = [
        'session' => SessionResource::class,
    ];
}
