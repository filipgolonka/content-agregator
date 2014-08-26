<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_ResponseTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Response
     */
    protected $_response;

    protected function setUp() {
        $this->_response = new Fg_Agregator_Response('Test response');
    }

    public function testHasProperTitle() {
        $this->assertEquals('Test response', $this->_response->getTitle());
    }

    public function testAddSection() {
        $section = array(
            'result' => '',
            'title' => 'Test',
            'partial' => '_test.phtml'
        );

        $this->_response->addSection($section['result'], $section['title'], $section['partial']);

        $sections = $this->_response->getSections();
        $this->assertEquals(1, count($sections));
        $this->assertEquals($section, array_pop($sections));
    }

}