<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Content_FactoryTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Content_Factory
     */
    protected $_factory;

    public function setUp() {
        $this->_factory = new Fg_Agregator_Content_Factory();
    }

    public function testCreate() {
        $config = new Zend_Config_Ini(TEST_CONFIGS_PATH . '/content.ini', APPLICATION_ENV);
        $availableSections = array_keys($config->content->toArray());
        $section = array_shift($availableSections);

        $result = $this->_factory->create($config->content->$section);

        $this->assertInstanceOf('Fg_Agregator_Content', $result);
    }

    /**
     * @expectedException Fg_Agregator_Content_Factory_Exception
     */
    public function testThrowsExceptionWhenNonExistingParserClassWasPassed() {
        $config = new Zend_Config_Ini(TEST_CONFIGS_PATH . '/nonExistingParserClass.ini', APPLICATION_ENV);
        $this->_factory->create($config->content->varnish);
    }

    /**
     * @expectedException Fg_Agregator_Content_Factory_Exception
     */
    public function testThrowsExceptionWhenNonExistingSourceClassWasPassed() {
        $config = new Zend_Config_Ini(TEST_CONFIGS_PATH . '/nonExistingSourceClass.ini', APPLICATION_ENV);
        $this->_factory->create($config->content->varnish);
    }

}