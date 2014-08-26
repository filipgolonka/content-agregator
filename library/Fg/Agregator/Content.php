<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Content {

    /**
     * @var Zend_Config
     */
    protected $_config;

    /**
     * @param \Zend_Config $config
     * @return $this
     */
    public function setConfig($config) {
        $this->_config = $config;
        return $this;
    }

    /**
     * @var Fg_Agregator_Source_Interface
     */
    protected $_source;

    /**
     * @param \Fg_Agregator_Source_Interface $source
     * @return $this
     */
    public function setSource($source) {
        $this->_source = $source;
        return $this;
    }

    /**
     * @var Fg_Agregator_Parser_Interface[]
     */
    protected $_parsers = array();

    /**
     * @param Fg_Agregator_Parser_Interface $parser
     * @return $this
     */
    public function addParser(Fg_Agregator_Parser_Interface $parser) {
        array_push($this->_parsers, $parser);
        return $this;
    }

    /**
     * @return Fg_Agregator_Response
     */
    public function get() {
        $response = new Fg_Agregator_Response($this->_config->title);
        $result = $this->_source->get();

        foreach($this->_parsers as $parser) {
            $parserResponse = $parser->parse($result);
            $response->addSection($parserResponse, $parser->getTitle(), $parser->getPartial());
        }

        return $response;
    }

}