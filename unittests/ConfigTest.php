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
    function testSetAndGet($Config) {
        $Config->set('a', 1);
        $var = $Config->get('a');
        $this->assertEquals(1, $var);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetObject($Config) {
        $testObject = new testClassForSet();
        $Config->set('a', $testObject);
        $var = $Config->get('a');
        $this->assertEquals('value 2', $var->var2);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetArray($Config) {
        $Config->set('a', ['a1', 'a2']);
        $var = $Config->get('a');
        $this->assertEquals('a2', $var[1]);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetArrayWithKey($Config) {
        $Config->set('a', [
            'a1' => 'var_a1',
            'a2' => 'var_a2'
        ]);
        $var = $Config->get('a');
        $this->assertEquals('var_a1', $var['a1']);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetObject_Only($Config) {
        $testObject = new testClassForSet();
        $Config->set($testObject);
        $var = $Config->get('var2');
        $this->assertEquals('value 2', $var);
    }

    /**
     * @depends testSingleton
     */
    function testSetAndGetArrayWithKey_Only($Config) {
        $Config->set([
            'a1' => 'var_a1',
            'a2' => 'var_a2'
        ]);
        $var = $Config->get('a1');
        $this->assertEquals('var_a1', $var);
    }

    /**
     * @depends testSingleton
     */
    function testClear($Config) {
        $Config->set('b', 1);
        $Config->clear('b');
        $var = $Config->get('b');
        $this->assertEquals(null, $var);
    }

    /**
     * @depends testSingleton
     */
    function testClearAll($Config) {
        $Config->set('c', 1);
        $Config->clear();
        $var = $Config->get('c');
        $this->assertEquals(null, $var);
    }

    /**
     * @depends testSingleton
     */
    function testHas($Config) {
        $Config->set('d', 1);
        $this->assertTrue($Config->has('d'));
    }

}