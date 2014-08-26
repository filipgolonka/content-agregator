<?php
/**
 * @author fgolonka
 */
class Fg_Agregator_Content_Factory {

    /**
     * @param Zend_Config $config
     * @return Fg_Agregator_Content
     */
    public function create(Zend_Config $config) {
        $content = new Fg_Agregator_Content();
        $content->setConfig($config);

        $source = $this->_createSource($config);
        $content->setSource($source);

        if(count($config->parser)) {
            foreach($config->parser as $parser) {
                $parserObject = $this->_createParser($parser);

                $content->addParser($parserObject);
            }
        }

        return $content;
    }

    /**
     * @param Zend_Config $config
     * @throws Fg_Agregator_Content_Factory_Exception
     * @return \Fg_Agregator_Source_Interface
     */
    protected function _createSource(Zend_Config $config) {
        $sourceClassName = 'Fg_Agregator_Source_' . ucfirst($config->source->type);
        if (!class_exists($sourceClassName)) {
            throw new Fg_Agregator_Content_Factory_Exception(sprintf('Class %s does not exist', $sourceClassName));
        }

        $source = new $sourceClassName();
        if (!($source instanceof Fg_Agregator_Source_Interface)) {
            throw new Fg_Agregator_Content_Factory_Exception(sprintf('Class %s has to implement Fg_Agregator_Source_Interface interface', $sourceClassName));
        }

        $source->setLocation($config->source->location);
        if($config->source->params) {
            $source->setParams($config->source->params->toArray());
        }

        return $source;
    }

    /**
     * @param Zend_Config $parserConfig
     * @return Fg_Agregator_Parser_Interface
     * @throws Fg_Agregator_Content_Factory_Exception
     */
    protected function _createParser($parserConfig) {
        $parserClassName = 'Fg_Agregator_Parser_' . ucfirst($parserConfig->type);
        if (!class_exists($parserClassName)) {
            throw new Fg_Agregator_Content_Factory_Exception(sprintf('Class %s does not exist', $parserClassName));
        }

        $parser = new $parserClassName();
        if (!($parser instanceof Fg_Agregator_Parser_Interface)) {
            throw new Fg_Agregator_Content_Factory_Exception(sprintf('Class %s has to implement Fg_Agregator_Parser_Interface', $parserClassName));
        }

        if($parserConfig->params) {
            $parser->setParams($parserConfig->params->toArray());
        }

        $parser->setPartial($parserConfig->partial);

        return $parser;
    }

}