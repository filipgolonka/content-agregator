<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Translator_Date2Timestamp implements Fg_Agregator_Translator_Interface {

    protected $_monthTranslations = array(
        'januar' => 'Jan',
        'februar' => 'February',
        'mars' => 'Mar',
        'april' => 'Apr',
        'mai' => 'May',
        'juni' => 'Jun',
        'juli' => 'Jul',
        'august' => 'Aug',
        'september' => 'Sep',
        'oktober' => 'Oct',
        'november' => 'Nov',
        'desember' => 'Dec',
    );

    /**
     * @param string $data
     * @return string
     */
    public function translate($data) {
        $data = strtolower($data);
        $data = str_replace(array_keys($this->_monthTranslations), array_values($this->_monthTranslations), $data);

        return strtotime($data);
    }

}