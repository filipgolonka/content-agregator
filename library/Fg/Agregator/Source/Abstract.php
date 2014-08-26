<?php
/**
 * @author fgolonka
 */
abstract class Fg_Agregator_Source_Abstract implements Fg_Agregator_Source_Interface {

    /**
     * @var string
     */
    protected $_location;

    /**
     * setter method for $location parameter
     * @param string $location
     * @return $this
     */
    public function setLocation($location) {
        $this->_location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation() {
        return $this->_location;
    }

}