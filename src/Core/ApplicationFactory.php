<?php

namespace RouteMap\Core;

use RouteMap\Core\Config;
use Flight;

class ApplicationFactory {

    public static function create() {
        $applicationName = self::getApplicationName();
        $className = "Application\\" . $applicationName;
        return new $className($applicationName);
    }

    private static function getApplicationName() {
        $applicationName = explode('/', $_SERVER['REQUEST_URI'])[1];
        return $applicationName ? $applicationName : self::getDefaultApplication();
    }

    private static function getDefaultApplication() {
        $applicationName = Config::getInstance()->get('default_application');
        $url = Config::getInstance()->get('default_url');
        Flight::request()->url = '/' . $applicationName . $url;
        return $applicationName;
    }

}