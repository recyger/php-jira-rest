<?php

$parameters = getopt("", ['host:', 'username:', 'password:']);
if (empty($parameters) || array_diff(['host', 'username', 'password'], array_keys($parameters)) !== []) {
    throw new InvalidArgumentException();
}
return $parameters;
