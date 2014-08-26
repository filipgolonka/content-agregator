<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Source_Rss extends Fg_Agregator_Source_Abstract implements Fg_Agregator_Source_Interface {

    /**
     * retrieving data from passed location
     * @throws Fg_Agregator_Source_Exception
     * @return array
     */
    public function get() {
        if(!$this->_location) {
            throw new Fg_Agregator_Source_Exception('You have to pass feed location to class ' . __CLASS__);
        }

        $content = new Zend_Feed_Rss($this->_location);

        return $this->parse($content);
    }

    /**
     * method for passing additional parameters
     * @param array $params
     * @throws Fg_Agregator_Source_Exception
     * @return $this
     */
    public function setParams($params) {
        throw new Fg_Agregator_Source_Exception('Not implemented yet');
    }

    /**
     * @param Zend_Feed_Rss $content
     * @return array
     */
    public function parse($content) {
        $result = array();
        foreach($content as $entry) {
            /** @var Zend_Feed_Entry_Rss $entry */
            $result [] = array(
                'title' => $entry->title(),
                'description' => $entry->description(),
                'link' => $entry->link(),
                'date' => $entry->pubDate(),
                'timestamp' => strtotime($entry->pubDate())
            );
        }

        return $result;
    }

}