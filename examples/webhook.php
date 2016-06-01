<?php

use JuriBlox\Sdk\Webhooks\Request;

require __DIR__  . '/bootstrap.php';

$request = Request::fromInput();

var_dump($request);