<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Translator_Url2HostnameTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Fg_Agregator_Translator_Interface
     */
    protected $_translator;

    protected function setUp() {
        $this->_translator = new Fg_Agregator_Translator_Url2Hostname();
    }

    /**
     * @dataProvider testTranslateProvider
     * @param string $url
     * @param string $expected
     */
    public function testTranslate($url, $expected) {
        $this->assertEquals($expected, $this->_translator->translate($url));
    }

    public function testTranslateProvider() {
        return array(
            array(
                'http://onet.pl',
                'onet.pl'
            ),
            array(
                'http://onet.pl/article.php?id=123',
                'onet.pl'
            )
        );
    }

}