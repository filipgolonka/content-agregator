<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Source_File extends Fg_Agregator_Source_Abstract implements Fg_Agregator_Source_Interface {

    /**
     * @var string
     */
    protected $_regexp;

    /**
     * @var array
     */
    protected $_map = array();

    /**
     * method for passing additional parameters
     * @param array $params
     * @throws Fg_Agregator_Source_Exception
     * @return $this
     */
    public function setParams($params) {
        if(count($params) != 2) {
            throw new Fg_Agregator_Source_Exception('Parameters array has to have two elements');
        }

        $this->_regexp = $params[0];
        $this->_map = $params[1];

        return $this;
    }

    /**
     * retrieving data from passed location
     * @throws Fg_Agregator_Source_Exception
     * @return array
     */
    public function get() {
        if(!$this->_location) {
            throw new Fg_Agregator_Source_Exception('You have to pass file location to class ' . __CLASS__);
        }
        $content = file_get_contents($this->_location);

        return $this->parse($content);
    }

    public function parse($content) {
        $explodedContent = explode("\n", $content);
        if(!$this->_regexp) {
            return $explodedContent;
        }

        $result = array();
        foreach($explodedContent as $row) {
            if(preg_match('/' . $this->_regexp . '/', $row, $matches)) {
                $tmp = array();
                foreach($this->_map as $key => $value) {
                    if(isset($matches[$key])) {
                        $tmp[$value] = $matches[$key];
                    }
                }

                $result [] = $tmp;
            }
        }

        return $result;
    }

}