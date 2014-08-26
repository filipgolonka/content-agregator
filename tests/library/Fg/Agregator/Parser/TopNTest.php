<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Parser_TopNTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Parser_TopN
     */
    protected $_parser;

    protected function setUp() {
        $this->_parser = new Fg_Agregator_Parser_TopN();
    }

    /**
     * @expectedException Fg_Agregator_Parser_Exception
     */
    public function testSetParamsThrowsExceptionWhenEmptyParamsArrayPassed() {
        $this->_parser->setParams(array());
    }

    public function testSetParamsWithoutTranslator() {
        $result = $this->_parser->setParams(array(
            5,
            'date'
        ));
        $this->assertEquals($this->_parser, $result);
    }

    public function testSetParamsWithTranslator() {
        $result = $this->_parser->setParams(array(
            4,
            'date',
            'url',
            'Fg_Agregator_Translator_Url2Hostname'
        ));

        $this->assertEquals($this->_parser, $result);
    }

    public function testGetTitle() {
        $this->_parser->setParams(array(
            5,
            'date'
        ));

        $this->assertEquals('Top 5 grouped by date', $this->_parser->getTitle());
    }

    /**
     * @dataProvider nameProvider
     */
    public function testParseWithoutTranslator($content, $expected) {
        $this->_parser->setParams(array(
            2,
            'name'
        ));
        $result = $this->_parser->parse($content);

        $this->assertEquals($expected, $result);
    }

    public function nameProvider() {
        return array(
            array(
                array(
                    array(
                        'name' => 'Golonka',
                    ),
                    array(
                        'name' => 'Nowak',
                    ),
                    array(
                        'name' => 'Golonka',
                    ),
                    array(
                        'name' => 'Kowalski'
                    ),
                    array(
                        'name' => 'Nowak'
                    ),
                    array(
                        'name' => 'Golonka'
                    )
                ),
                array(
                    'Golonka' => 3,
                    'Nowak' => 2
                )
            )
        );
    }

    /**
     * @dataProvider urlProvider
     */
    public function testParseWithTranslator($content, $expected) {
        $this->_parser->setParams(array(
            2,
            'hostname',
            'url',
            'Fg_Agregator_Translator_Url2Hostname'
        ));

        $result = $this->_parser->parse($content);

        $this->assertEquals($expected, $result);
    }

    public function urlProvider() {
        return array(
            array(
                array(
                    array('url' => 'http://onet.pl/test.php'),
                    array('url' => 'http://onet.pl/blahblah.php'),
                    array('url' => 'http://onet.pl/test123.php'),
                    array('url' => 'http://wp.pl/pop.php'),
                    array('url' => 'http://www.github.com/filipgolonka'),
                    array('url' => 'http://www.github.com/NonExistingUser'),
                ),
                array(
                    'onet.pl' => 3,
                    'www.github.com' => 2
                )
            )
        );
    }

}