<?php

use PHPUnit\Framework\TestCase;
use RouteMap\Core\ApplicationFactory;
use RouteMap\Core\Application;
use Flight;

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
        Flight::redirectOutside('/Application2/var2');
        ob_clean(); //redirectOutside will echo path
        $this->assertEquals('/', Flight::request()->base);
    }

    public function testGetDefaultApplication() {
        $_SERVER['REQUEST_URI'] = '/';
        $app = ApplicationFactory::create();
        $this->assertEquals('Application\Index', get_class($app));
    }

    /*
    public function testDefaultUrl() {
        $_SERVER['REQUEST_URI'] = '/';
        echo Flight::request()->url;
        $this->assertEquals('/hello', Flight::request()->url);
    }
    */

}