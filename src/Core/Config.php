<?php

namespace RouteMap\Core;

/*
    Proxy for Flight get set and use Singleton pattern to initialization RouteMap config
*/

use Flight;

class Config {

    private static $instance;

    private function __construct() {}

    public static function getInstance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($key = null) {
        return Flight::get($key);
    }

    public function set($key, $value = null) {
        Flight::set($key, $value);
    }

    public function has($key) {
        return Flight::has($key);
    }

    public function clear($key = null) {
        Flight::clear($key);
    }

}