<?php

use PHPUnit\Framework\TestCase;
use RouteMap\Core\ApplicationFactory;
use RouteMap\Core\Application;

class ApplicationTest extends TestCase {

    public function testFactory() {
        $_SERVER['REQUEST_URI'] = '/Index/var1';
        $app = ApplicationFactory::create();
        $this->assertEquals('Application\Index', get_class($app));
        return $app;
    }

    /**
     * @depends testFactory
     */
    public function testGetApplication($app) {
        $this->assertEquals('Index', $app->getApplication());
    }

    public function testBase() {
        $this->assertEquals('/Index', Flight::request()->base);
    }

    public function testUrl() {
        $this->assertEquals('/var1', Flight::request()->url);
    }

    public function testExtensionFlightFunction() {
        $extensionFlightFunction = [
            '\Flight', 
            'redirectOutside'
        ];
        $this->assertTrue(is_callable($extensionFlightFunction));
    }

    public function testFlightRedirectOutside() {
        Flight::redirectOutside('/otherApplication');
        $this->assertEquals('/', Flight::request()->base);
        $this->assertEquals('/otherApplication', ob_get_contents());
        ob_clean(); //redirectOutside will echo path
    }

    public function testGetDefaultApplicationAndUrl() {
        $_SERVER['REQUEST_URI'] = '/';
        $app = ApplicationFactory::create();
        $this->assertEquals('Application\Index', get_class($app));
        $this->assertEquals('/', Flight::request()->url);
    }

}