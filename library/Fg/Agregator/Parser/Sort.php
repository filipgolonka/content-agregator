<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Parser_Sort extends Fg_Agregator_Parser_Abstract implements Fg_Agregator_Parser_Interface {

    /**
     * @var string
     */
    protected $_sortBy;

    /**
     * @var string
     */
    protected $_sortOrder;

    /**
     * setter for additional parser parameters
     * @param array $params
     * @throws Fg_Agregator_Parser_Exception
     * @return $this
     */
    public function setParams($params) {
        if(count($params) < 2) {
            throw new Fg_Agregator_Parser_Exception('Parameters array has to have at least 2 elements');
        }

        $this->_sortBy = array_shift($params);
        $this->_sortOrder = strtolower(array_shift($params));
        if(count($params)) {
            $this->_setTranslatorParams($params);
        }

        return $this;
    }

    /**
     * parsing function - should return result array
     * @param array $content
     * @return array
     */
    public function parse($content) {
        $content = $this->_translate($content);
        usort($content, array($this, '_compare'));
        return $content;
    }

    /**
     * @param array $content
     * @return array
     */
    protected function _translate($content) {
        if(!$this->_fieldForTranslate || !$this->_translator) {
            return $content;
        }

        foreach($content as &$row) {
            $row[$this->_sortBy] = $this->_translator->translate($row[$this->_fieldForTranslate]);
        }

        return $content;
    }

    protected function _compare($firstRecord, $secondRecord) {
        $firstField = $firstRecord[$this->_sortBy];
        $secondField = $secondRecord[$this->_sortBy];

        if($firstField > $secondField) {
            return $this->_sortOrder == 'desc' ? -1 : 1;
        } elseif ($firstField == $secondField) {
            return 0;
        } else {
            return $this->_sortOrder == 'desc' ? 1 : -1;
        }
    }

    /**
     * @return string
     */
    public function getTitle() {
        return 'Records sorted by ' . $this->_sortBy;
    }

}