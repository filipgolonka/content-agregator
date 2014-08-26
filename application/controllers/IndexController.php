<?php
/**
 * @author fgolonka
 */
class IndexController extends Zend_Controller_Action {

    public function indexAction() {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/content.ini', APPLICATION_ENV);

        $this->view->availableSections = array();
        foreach($config->content as $key => $row) {
            $this->view->availableSections[$key] = $row->title;
        }

        $availableSections = array_keys($config->content->toArray());

        $type = $this->getRequest()->getParam('type');
        if(!$type || !in_array($type, $availableSections)) {
            $type = array_shift($availableSections);
        }
        $this->view->type = $type;

        $currentSection = $config->content->$type;

        $contentFactory = new Fg_Agregator_Content_Factory();
        $content = $contentFactory->create($currentSection);

        $response = $content->get();
        $this->view->response = $response;
    }

}