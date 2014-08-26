<?php
/**
 * @author fgolonka
 */
interface Fg_Agregator_Parser_Interface {

    /**
     * setter for additional parser parameters
     * @param array $params
     * @return $this
     */
    public function setParams($params);

    /**
     * parsing function - should return result array
     * @param array $content
     * @return array
     */
    public function parse($content);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $partial
     * @return $this
     */
    public function setPartial($partial);

    /**
     * @return string
     */
    public function getPartial();

}