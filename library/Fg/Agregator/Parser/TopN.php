<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Parser_TopN extends Fg_Agregator_Parser_Abstract implements Fg_Agregator_Parser_Interface {

    /**
     * @var int
     */
    protected $_topN;

    /**
     * @var string
     */
    protected $_groupBy;

    /**
     * setter for additional parser parameters
     * @param array $params
     * @throws Fg_Agregator_Parser_Exception
     * @return $this
     */
    public function setParams($params) {
        if(count($params) == 0) {
            throw new Fg_Agregator_Parser_Exception('Parameters array has to have at least 1 element');
        }

        $this->_topN = array_shift($params);
        if(count($params)) {
            $this->_groupBy = array_shift($params);
        }

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
        $result = $this->_group($content);
        $result = $this->_sort($result);
        $result = $this->_limit($result);

        return $result;
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
            $row[$this->_groupBy] = $this->_translator->translate($row[$this->_fieldForTranslate]);
        }

        return $content;
    }

    /**
     * @param array $content
     * @return array
     */
    protected function _group($content) {
        $result = array();
        foreach($content as $row) {
            if(!isset($result[$row[$this->_groupBy]])) {
                $result[$row[$this->_groupBy]] = 0;
            }

            $result[$row[$this->_groupBy]]++;
        }

        return $result;
    }

    protected function _sort($content) {
        arsort($content);
        return $content;
    }

    /**
     * @param array $content
     * @return array
     */
    protected function _limit($content) {
        return array_slice($content, 0, $this->_topN);
    }

    /**
     * @return string
     */
    public function getTitle() {
        return sprintf('Top %s grouped by %s', $this->_topN, $this->_groupBy);
    }

}