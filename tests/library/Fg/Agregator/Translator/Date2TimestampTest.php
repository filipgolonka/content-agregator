<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Translator_Date2TimestampTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Translator_Interface
     */
    protected $_translator;

    protected function setUp() {
        $this->_translator = new Fg_Agregator_Translator_Date2Timestamp();
    }

    /**
     * @dataProvider testTranslateProvider
     * @param string $date
     * @param string $expected
     */
    public function testTranslate($date, $expected) {
        $this->assertEquals($expected, $this->_translator->translate($date));
    }

    public function testTranslateProvider() {
        return array(
            array(
                '29 Mars 2012 12:31',
                '1333017060'
            ),
            array(
                '13 Februar 2012 12:38',
                '1329133080'
            )
        );
    }

}