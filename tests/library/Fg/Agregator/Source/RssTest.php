<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Source_RssTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Source_Rss
     */
    protected $_source;

    protected function setUp() {
        $this->_source = new Fg_Agregator_Source_Rss();
    }

    /**
     * @expectedException Fg_Agregator_Source_Exception
     */
    public function testSetParamsIsNotImplemented() {
        $this->_source->setParams(array());
    }

    /**
     * @expectedException Fg_Agregator_Source_Exception
     */
    public function testGetThrowsExceptionWhenLocationWasNotPassed() {
        $this->_source->get();
    }

    public function testGet() {
        $this->_source->setLocation('http://www.vg.no/rss/feed/forsiden/?frontId=1');
        $result = $this->_source->get();

        $this->assertTrue(is_array($result));
    }

}