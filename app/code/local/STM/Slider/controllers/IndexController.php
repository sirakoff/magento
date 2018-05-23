<?php
class STM_Slider_IndexController extends Mage_Adminhtml_Controller_Action
{  
    public function indexAction()
    {
        $this->loadLayout();
        
        $script = $this->getLayout()->createBlock('core/text', 'slider-script')->setText('<script src="http://api.nallem.local:8000/js/app.js"></script>');
        $app = $this->getLayout()->createBlock('core/text', 'slider-app')->setText('<div id="app"></div>');
        
        $this->_addContent($app);
        $this->_addContent($script);
         
        $this->_setActiveMenu('slider_menu')->renderLayout();      
    }   
}