<?php
use recyger\JIRARESTClient\JIRA;

require __DIR__ . '/../vendor/autoload.php';

$parameter = require 'parameters.php';

$testingDisplayName = 'Testing Display Name';
$testingPassword    = 'TestingPassword';

$connector         = new JIRA($parameter['host'], $parameter['username'], $parameter['password']);
$myselfResource    = $connector->api->latest->myself;
$myselfEntry       = $myselfResource->get();
$originDisplayName = $myselfEntry->displayName;
$originPassword    = $parameter['password'];
$currentPassword   = $originPassword;

printf('Current display name: %s', $originDisplayName);
echo PHP_EOL;

printf('Current email: %s', $myselfEntry->emailAddress);
echo PHP_EOL;
printf('Try change display name on %s', $testingDisplayName);
echo PHP_EOL;

$myselfEntry->displayName = $testingDisplayName;

if ($myselfResource->update($currentPassword)) {
    echo 'Success' . PHP_EOL;
} else {
    echo 'Fail' . PHP_EOL;
    exit(1);
}

printf('Current display name: %s', $myselfEntry->displayName);
echo PHP_EOL;

printf('Try change password on %s', $testingPassword);
echo PHP_EOL;

if ($myselfResource->changeMyPassword($currentPassword, $testingPassword)) {
    echo 'Success' . PHP_EOL;
    $currentPassword = $testingPassword;
} else {
    echo 'Fail' . PHP_EOL;
    exit(1);
}

printf('Return origin display name');
echo PHP_EOL;

$myselfEntry->displayName = $originDisplayName;
if ($myselfResource->update($currentPassword)) {
    echo 'Success' . PHP_EOL;
} else {
    echo 'Fail' . PHP_EOL;
    exit(1);
}

printf('Current display name: %s', $myselfEntry->displayName);
echo PHP_EOL;

printf('Return origin password');
echo PHP_EOL;

if ($myselfResource->changeMyPassword($currentPassword, $originPassword)) {
    echo 'Success' . PHP_EOL;
    $currentPassword = $originPassword;
} else {
    echo 'Fail' . PHP_EOL;
}
