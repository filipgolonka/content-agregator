<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Translator_Url2Hostname implements Fg_Agregator_Translator_Interface {

    /**
     * @param string $data
     * @return string
     */
    public function translate($data) {
        $host = parse_url($data, PHP_URL_HOST);

        return $host;
    }

}