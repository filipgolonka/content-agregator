<?php
/**
 * @author fgolonka
 */
abstract class Fg_Agregator_Parser_Abstract implements Fg_Agregator_Parser_Interface {

    /**
     * @var string
     */
    protected $_partial;

    /**
     * @param string $partial
     * @return $this
     */
    public function setPartial($partial) {
        $this->_partial = $partial;
        return $this;
    }

    /**
     * @throws Fg_Agregator_Parser_Exception
     * @return string
     */
    public function getPartial() {
        if(!$this->_partial) {
            throw new Fg_Agregator_Parser_Exception('You have to configure partial view for Parser class');
        }
        return $this->_partial;
    }

    /**
     * @var string
     */
    protected $_fieldForTranslate;

    /**
     * @var Fg_Agregator_Translator_Interface
     */
    protected $_translator;

    /**
     * setter for translator params - it is called from setParams() method
     * @param array $params
     * @throws Fg_Agregator_Parser_Exception
     */
    protected function _setTranslatorParams($params) {
        if(count($params) != 2) {
            throw new Fg_Agregator_Parser_Exception('You have to specify both field for translate and translator class name');
        }

        $this->_fieldForTranslate = array_shift($params);

        $translatorClassName = array_shift($params);
        if(!class_exists($translatorClassName)) {
            throw new Fg_Agregator_Parser_Exception(sprintf('Class %s does not exist', $translatorClassName));
        }

        $translator = new $translatorClassName();
        if(!($translator instanceof Fg_Agregator_Translator_Interface)) {
            throw new Fg_Agregator_Parser_Exception(sprintf('Class %s has to have implemented Fg_Agregator_Translator_Interface interface', $translatorClassName));
        }

        $this->_translator = $translator;
    }

}