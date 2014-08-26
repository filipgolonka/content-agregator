<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_ContentTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Content
     */
    protected $_content;

    protected function setUp() {
        $this->_content = new Fg_Agregator_Content();
    }

    public function testSetConfig() {
        $this->assertEquals($this->_content, $this->_content->setConfig('test'));
    }

    public function testSetSource() {
        $this->assertEquals($this->_content, $this->_content->setSource('test'));
    }

    public function testAddParser() {
        $this->assertEquals($this->_content, $this->_content->addParser(new Fg_Agregator_Parser_Sort()));
    }

    public function testGet() {
        $config = new Zend_Config_Ini(TEST_CONFIGS_PATH . '/content.ini', APPLICATION_ENV);
        $availableSections = array_keys($config->content->toArray());
        $section = array_shift($availableSections);

        $factory = new Fg_Agregator_Content_Factory();
        $content = $factory->create($config->content->$section);

        $response = $content->get();

        $this->assertInstanceOf('Fg_Agregator_Response', $response);
    }

}