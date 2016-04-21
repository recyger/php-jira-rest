<?php
use recyger\JIRARESTClient\JIRA;

require __DIR__ . '/../vendor/autoload.php';

$parameter = require 'parameters.php';

$connector          = new JIRA($parameter['host'], $parameter['username'], $parameter['password']);
$user               = $connector->api->latest->user->get(null, $parameter['username']);
$currentDisplayName = $user->displayName;

printf('User display name : %s', $currentDisplayName);
