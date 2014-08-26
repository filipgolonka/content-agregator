<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Source_FileTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Source_File
     */
    protected $_source;

    protected function setUp() {
        $this->_source = new Fg_Agregator_Source_File();
    }

    public function testSetLocation() {
        $this->assertEquals($this->_source, $this->_source->setLocation('Test'));
        $this->assertEquals('Test', $this->_source->getLocation());
    }

    /**
     * @expectedException Fg_Agregator_Source_Exception
     */
    public function testSetParamsThrowsException() {
        $this->_source->setParams(array('oneItem'));
    }

    public function testSetParams() {
        $result = $this->_source->setParams(array(
            'firstParam',
            array()
        ));

        $this->assertEquals($this->_source, $result);
    }

    /**
     * @expectedException Fg_Agregator_Source_Exception
     */
    public function testGetThrowsExceptionWhenLocationWasNotPassed() {
        $this->_source->get();
    }

    public function testGet() {
        $this->_source->setLocation(APPLICATION_PATH . '/../public/varnish.log');
        $result = $this->_source->get();

        $this->assertTrue(is_array($result));
    }

    public function testGetReturnsParsedResult() {
        $this->_source->setLocation(APPLICATION_PATH . '/../public/varnish.log');
        $this->_source->setParams(array(
            '([0-9\.]+) (.*?) "([A-Z]+) (http(.*)) HTTP(.*)',
            array(
                1 => 'ip',
                3 => 'method',
                4 => 'url'
            )
        ));

        $result = $this->_source->get();

        $this->assertTrue(is_array($result));
    }

}