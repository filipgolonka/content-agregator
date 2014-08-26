<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Source_Json extends Fg_Agregator_Source_Abstract implements Fg_Agregator_Source_Interface {

    /**
     * retrieving data from passed location
     * @throws Fg_Agregator_Source_Exception
     * @return array
     */
    public function get() {
        if(!$this->_location) {
            throw new Fg_Agregator_Source_Exception('You have to pass not empty location');
        }
        $content = file_get_contents($this->_location);

        return $this->_parse($content);
    }

    /**
     * @param array $content
     * @throws Fg_Agregator_Source_Exception
     * @return array
     */
    protected function _parse($content) {
        $content = json_decode($content);
        if(!$content) {
            throw new Fg_Agregator_Source_Exception('Can not parse JSON content');
        }

        $result = array();
        foreach($content as $row) {
            $result [] = array(
                'title' => $row->title,
                'link' => $row->link,
                'description' => isset($row->description) ? $row->description : '',
                'date' => $row->date . ' ' . $row->time,
                'timestamp' => strtotime($row->date . ' ' . $row->time)
            );
        }

        return $result;
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
}