<?php

class AhoomPay_Model_Pay extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'ahoom_pay';
    protected $_canUseInternal = true;
    protected $_canUseCheckout = false;
    protected $_isInitializeNeeded = true;
    protected $_canCapture = true;
    protected $_infoBlockType = 'AhoomPay_Block_Info';

    public function isAvailable($quote = null){
        
        if(!$quote){
			return false;
		}
		
		if($quote->getAllVisibleItems() <= 2){
			return false;
		}
		
		return true;
	}

}
