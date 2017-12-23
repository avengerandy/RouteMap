<?php

namespace RouteMap\Core;

use RouteMap\Core\Config;
use Illuminate\Support\Collection;
use Medoo\Medoo;

class DBFactory {

    private static $instanceList = [];

    public static function getDB($DBConfig) {
        $DBConfigCollection = new Collection($DBConfig);
        $DBConfigKey = $DBConfigCollection->sort()->toJson();
        if ( isset(self::$instanceList[$DBConfigKey]) ) {
            return self::$instanceList[$DBConfigKey];
        }
        $newInstance = new Medoo($DBConfig);
        self::$instanceList[$DBConfigKey] = $newInstance;
        return self::$instanceList[$DBConfigKey];
    }

    private function getNewInstance(){}

}