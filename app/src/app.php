<?php

require_once __DIR__ . '/../vendor/autoload.php';

$calc = new \Netlogix\PhpUnit\Service\CalcService();

dump($calc->addition(1, 2));
dump($calc->subtraction(1, 2));