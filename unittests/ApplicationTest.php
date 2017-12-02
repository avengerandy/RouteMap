<?php

use PHPUnit\Framework\TestCase;
use RouteMap\Core\ApplicationFactory;
use RouteMap\Core\Application;

class ApplicationTest extends TestCase {
    
    public function testFactory() {
        $_SERVER['REQUEST_URI'] = '/application1/var1';
        $app = ApplicationFactory::create();
        $this->assertEquals('Application\application1', get_class($app));
        return $app;
    }

    /**
     * @depends testFactory
     */
    public function testGetApplication($app) {
        $this->assertEquals('application1', $app->getApplication());
    }

    public function testBase() {
        $this->assertEquals('/application1', Flight::request()->base);
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
        Flight::redirectOutside('/application2/var2');
        ob_clean(); //redirectOutside will echo path
        $this->assertEquals('/', Flight::request()->base);
    }

}