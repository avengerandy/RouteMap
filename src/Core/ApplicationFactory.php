<?php

namespace RouteMap\Core;

class ApplicationFactory {

    public static function create() {
        $application = self::getApplicationName();
        $className = "Application\\" . $application;
        return new $className($application);
    }

    private static function getApplicationName() {
        return explode('/', $_SERVER['REQUEST_URI'])[1];
    }

}