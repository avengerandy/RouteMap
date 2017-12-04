<?php

use PHPUnit\Framework\TestCase;
use RouteMap\Core\Config;

//vendor/bin/phpunit --version

class testClassForSet {
    public $var1 = 'value 1';
    public $var2 = 'value 2';
    public $var3 = 'value 3';
}

class ConfigTest extends TestCase {

    public function testSingleton() {
        $ConfigA = Config::getInstance();
        $ConfigB = Config::getInstance();
        $this->assertTrue($ConfigA === $ConfigB);
        return $ConfigA;
    }

    /**
     * @depends testSingleton
     */
    function testConfigFile($Config) {
        $var = $Config->get('framework');
        $this->assertEquals('RouteMap', $var);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetWithBasicValue($Config) {
        $Config->set('keyName', 'value');
        $var = $Config->get('keyName');
        $this->assertEquals('value', $var);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetWithObjectValue($Config) {
        $testObject = new testClassForSet();
        $Config->set('keyName', $testObject);
        $var = $Config->get('keyName');
        $this->assertEquals('value 2', $var->var2);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetWithArrayValue($Config) {
        $Config->set('keyName', ['value1', 'value2']);
        $var = $Config->get('keyName');
        $this->assertEquals('value2', $var[1]);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetWithAssocationArrayValue($Config) {
        $Config->set('keyName', [
            'subKey1' => 'value1',
            'subKey2' => 'value2'
        ]);
        $var = $Config->get('keyName');
        $this->assertEquals('value1', $var['subKey1']);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetWithObjectKey($Config) {
        $testObject = new testClassForSet();
        $Config->set($testObject);
        $var = $Config->get('var2');
        $this->assertEquals('value 2', $var);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetWithAssocationArrayKey($Config) {
        $Config->set([
            'keyName1' => 'value1',
            'keyName2' => 'value2'
        ]);
        $var = $Config->get('keyName1');
        $this->assertEquals('value1', $var);
    }

    /**
     * @depends testSingleton
     */
    function testClear($Config) {
        $Config->set('keyName', 'value');
        $Config->clear('keyName');
        $var = $Config->get('keyName');
        $this->assertNull($var);
    }

    /**
     * @depends testSingleton
     */
    function testClearAll($Config) {
        $Config->set('keyName', 'value');
        $Config->clear();
        $var = $Config->get('keyName');
        $this->assertNull($var);
    }

    /**
     * @depends testSingleton
     */
    function testHas($Config) {
        $Config->set('keyName', 'value');
        $this->assertTrue($Config->has('keyName'));
    }

}