<?php

namespace RouteMap\Core;

use Flight;

abstract class Application {

    private $application;

    public function __construct($application) {
        $this->application = $application;
        $this->initBaseUrl();
        $this->extensionFlightFunction();
    }

    private function initBaseUrl() {
        Flight::request()->base = '/' . $this->application;
        Flight::request()->url = $this->getUrlWithoutBase([
            'url' => Flight::request()->url,
            'base' => Flight::request()->base
        ]);
    }

    private function getUrlWithoutBase($Dictionary) {
        return substr($Dictionary['url'], strlen($Dictionary['base']));
    }

    private function extensionFlightFunction() {
        Flight::map('redirectOutside', function($url){
            Flight::request()->base = '/';
            Flight::redirect($url);
        });
    }

    abstract public function router();

    public function getApplication() {
        return $this->application;
    }

    public function start() {
		Flight::start();
    }

}