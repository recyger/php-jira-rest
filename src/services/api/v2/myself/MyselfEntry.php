<?php
namespace recyger\JIRARESTClient\services\api\v2\myself;

use recyger\JIRARESTClient\services\api\v2\user\UserEntry;

class MyselfEntry extends UserEntry
{
    public function getAttributeForUpdate()
    {
        return [
            "emailAddress" => $this->emailAddress,
            "displayName"  => $this->displayName,
        ];
    }
}
