<?php

/**
 * Interface Fg_Agregator_Source_Interface
 * @author fgolonka
 */
interface Fg_Agregator_Source_Interface {

    /**
     * retrieving data from passed location
     * @return array
     */
    public function get();

    /**
     * setter method for $location parameter
     * @param string $location
     * @return $this
     */
    public function setLocation($location);

    /**
     * method for passing additional parameters
     * @param array $params
     * @return $this
     */
    public function setParams($params);

}