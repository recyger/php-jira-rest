<?php
namespace recyger\JIRARESTClient\services\api;

use recyger\JIRARESTClient\common\Parental;
use recyger\JIRARESTClient\services\api\v2\V2;

/**
 * Class API
 *
 * @property V2 v2
 * @property V2 latest
 *
 * @package recyger\JIRAREST\services\api
 */
class API extends Parental
{
    protected $_itemsClasses = [
        'v2'     => V2::class,
        'latest' => V2::class,
    ];
}
