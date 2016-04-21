<?php
require __DIR__ . '/../vendor/autoload.php';
use recyger\JIRARESTClient\JIRA;

$parameter = require 'parameters.php';

$connector       = new JIRA($parameter['host']);
$sessionResource = $connector->auth->latest->session;

echo 'Try login' . PHP_EOL;
if ($sessionResource->login($parameter['username'], $parameter['password'])) {
    echo 'Success' . PHP_EOL;
} else {
    echo 'Fail' . PHP_EOL;
    exit(1);
}

$sessionEntry = $sessionResource->get();
printf('Current name %s', $sessionEntry->name);
echo PHP_EOL;

echo 'Try logout' . PHP_EOL;
if ($sessionResource->logout()) {
    echo 'Success' . PHP_EOL;
} else {
    echo 'Fail' . PHP_EOL;
    exit(1);
}

echo 'Try get' . PHP_EOL;

$sessionEntry = $sessionResource->get();

printf('Current name %s', $sessionEntry->name);
