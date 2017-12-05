<?php

require 'vendor/autoload.php';

use RouteMap\Core\ApplicationFactory;
use Illuminate\Support\Collection;

$app = ApplicationFactory::create();
$app->router();
$app->start();

/*
$a = new Collection([
    'var1' => 'value1',
    'var1' => 'value2',
    'var3' => 'value3',
    'var4' => 'value4'
]);

$b = new Collection([
    'var4' => 'value4',
    'var1' => 'value3',
    'var1' => 'value1',
    'var2' => 'value2'
]);

$a->sort()->dump();
$b->sort()->dump();

$a = $a->sort()->toJson();
$b = $b->sort()->toJson();

echo($a);*/