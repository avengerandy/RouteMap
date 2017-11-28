<?php

require 'vendor/autoload.php';

use RouteMap\Core\ApplicationFactory;

$app = ApplicationFactory::create();
$app->router();
$app->start();
