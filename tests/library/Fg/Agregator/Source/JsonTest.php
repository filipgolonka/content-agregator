<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Source_JsonTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Source_Json
     */
    protected $_source;

    protected function setUp() {
        $this->_source = new Fg_Agregator_Source_Json();
    }

    public function testSetLocation() {
        $this->assertEquals($this->_source, $this->_source->setLocation('Test'));
        $this->assertEquals('Test', $this->_source->getLocation());
    }

    /**
     * @expectedException Fg_Agregator_Source_Exception
     */
    public function testGetThrowsExceptionWhenLocationWasNotPassed() {
        $this->_source->get();
    }

    /**
     * @expectedException Fg_Agregator_Source_Exception
     */
    public function testGetThrowsExceptionWhenLocationWithMalformedContentWasPassed() {
        $this->_source->setLocation(APPLICATION_PATH . '/../public/varnish.log');
        $this->_source->get();
    }

    public function testGet() {
        $this->_source->setLocation('http://rexxars.com/playground/testfeed/');
        $result = $this->_source->get();

        $this->assertTrue(is_array($result));
    }

    /**
     * @expectedException Fg_Agregator_Source_Exception
     */
    public function testSetParamsIsNotImplemented() {
        $this->_source->setParams(array());
    }

}