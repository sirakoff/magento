<?php
class STM_Slider_IndexController extends Mage_Adminhtml_Controller_Action
{  
    public function indexAction()
    {
        $this->loadLayout();

        $base = Mage::getBaseUrl( Mage_Core_Model_Store::URL_TYPE_WEB, true);
        $base = str_replace('magento', 'api', $base);
        
        $script = $this->getLayout()->createBlock('core/text', 'slider-script')->setText('<script src="'.$base.'js/app.js"></script>');
        $app = $this->getLayout()->createBlock('core/text', 'slider-app')->setText('<div id="app"></div>');
        
        $this->_addContent($app);
        $this->_addContent($script);
         
        $this->_setActiveMenu('slider_menu')->renderLayout();      
    }   
}