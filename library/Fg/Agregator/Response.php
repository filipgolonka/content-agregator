<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Response {

    protected $_title;

    /**
     * @var array
     */
    protected $_sections = array();

    public function __construct($title) {
        $this->_title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->_title;
    }

    /**
     * @param array $result
     * @param string $title
     * @param string $partial
     * @return $this
     */
    public function addSection($result, $title, $partial) {
        array_push($this->_sections, array(
            'result' => $result,
            'title' => $title,
            'partial' => $partial
        ));
        return $this;
    }

    public function getSections() {
        return $this->_sections;
    }

}