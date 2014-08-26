<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Parser_SortTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Parser_Sort
     */
    protected $_parser;

    protected function setUp() {
        $this->_parser = new Fg_Agregator_Parser_Sort();
    }

    public function testSetPartial() {
        $this->assertEquals($this->_parser, $this->_parser->setPartial('test'));
        $this->assertEquals('test', $this->_parser->getPartial());
    }

    /**
     * @expectedException Fg_Agregator_Parser_Exception
     */
    public function testGetPartialThrowsExceptionWhenPartialWasNotPassedBefore() {
        $this->_parser->getPartial();
    }

    /**
     * @expectedException Fg_Agregator_Parser_Exception
     */
    public function testSetParamsThrowsException() {
        $this->_parser->setParams(array(
            'oneParam'
        ));
    }

    public function testSetParams() {
        $result = $this->_parser->setParams(array(
            'firstParam',
            'secondParam',
            'thirdParam',
            'Fg_Agregator_Translator_Date2Timestamp'
        ));

        $this->assertEquals($this->_parser, $result);
    }

    /**
     * @expectedException Fg_Agregator_Parser_Exception
     */
    public function testSetParamsThrowsExceptionWhenNonExistingTranslatorClassNameWasPassed() {
        $this->_parser->setParams(array(
            'firstParam',
            'secondParam',
            'thirdParam',
            'NonExistingClass'
        ));
    }

    /**
     * @expectedException Fg_Agregator_Parser_Exception
     */
    public function testSetParamsThrowsExceptionWhenTranslatorClassDoesNotImplementProperInterface() {
        $this->_parser->setParams(array(
            'firstParam',
            'secondParam',
            'thirdParam',
            'Fg_Agregator_Source_Json'
        ));
    }

    /**
     * @expectedException Fg_Agregator_Parser_Exception
     */
    public function testSetParamsThrowsExceptionWhenIncompleteTranslatorParamsWasPassed() {
        $this->_parser->setParams(array(
            'firstParam',
            'secondParam',
            'thirdParam',
        ));
    }

    public function testGetTitle() {
        $this->_parser->setParams(array(
            'test',
            'desc'
        ));

        $this->assertEquals('Records sorted by test', $this->_parser->getTitle());
    }

    /**
     * @dataProvider contentProvider
     */
    public function testParseWithTranslator($content) {
        $this->_parser->setParams(array(
            'timestamp',
            'desc',
            'date',
            'Fg_Agregator_Translator_Date2Timestamp'
        ));

        $result = $this->_parser->parse($content);

        $this->assertArrayHasKey('timestamp', $result[0]);
        $this->assertTrue(is_array($result));
    }

    public function contentProvider() {
        $content = array(
            array(
                'date' => '12 Mar 2011 14:00:00',
            ),
            array(
                'date' => '12 Mar 2011 14:00:00',
            ),
            array(
                'date' => '01 Apr 2011 14:00:00'
            ),
            array(
                'date' => '01 Mar 2011 14:00:00'
            )
        );
        return array(
            array($content)
        );
    }

    /**
     * @dataProvider contentProvider
     */
    public function testParseWithoutTranslator($content) {
        $this->_parser->setParams(array(
            'date',
            'desc',
        ));

        $result = $this->_parser->parse($content);

        $this->assertTrue(is_array($result));
    }

}