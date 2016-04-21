<?php
namespace recyger\JIRARESTClient\services\api\v2\user;

use recyger\JIRARESTClient\common\EntryBase;

/**
 * Class UserEntry
 *
 * @property  string self
 * @property  string name
 * @property  string emailAddress
 * @property  string displayName
 * @property  string active
 * @property  string timeZone
 *
 * @package recyger\JIRARESTClient\services\api\v2\user
 */
class UserEntry extends EntryBase
{
    protected $_fieldsName = [
        'self',
        'name',
        'emailAddress',
        'displayName',
        'active',
        'timeZone',
        'locale',
        'key',
    ];
}
