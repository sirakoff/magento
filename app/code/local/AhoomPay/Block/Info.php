<?php

class AhoomPay_Block_Info extends Mage_Payment_Block_Info {

    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation) {
            return $this->_paymentSpecificInformation;
        }
        
        $data = $this->getInfo()->getAdditionalInformation();

        // Mage::log("Flushing key ". json_encode($data), null, 'payment_ahoom_pay.log', true);

        // $info = $this->getInfo();
        $transport = new Varien_Object();
        $transport = parent::_prepareSpecificInformation($transport);
        $transport->addData(array(
            'Mode' => $data['mode'],
            'Transaction ID' => $data['transactionId'],
            // 'Payment Token' => $data['payToken'],
            // 'Currency' => $data['currency']
        ));

        return $transport;
    }

}
