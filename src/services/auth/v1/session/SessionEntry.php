<?php


namespace recyger\JIRARESTClient\services\auth\v1\session;


use recyger\JIRARESTClient\common\EntryBase;

class SessionEntry extends EntryBase
{
    protected $_fieldsName = [
        'self',
        'name',
        'loginInfo',
    ];
}
