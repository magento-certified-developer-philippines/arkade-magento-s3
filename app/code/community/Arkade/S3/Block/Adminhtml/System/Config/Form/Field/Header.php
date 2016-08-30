<?php

class Arkade_S3_Block_Adminhtml_System_Config_Form_Field_Header extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    public function __construct()
    {
        $this->addColumn('header', array(
            'label' => Mage::helper('arkade_s3')->__('Header'),
            'style' => 'width:120px',
        ));
        $this->addColumn('value', array(
            'label' => Mage::helper('arkade_s3')->__('Value'),
            'style' => 'width:120px',
        ));
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('arkade_s3')->__('Add Header');
        parent::__construct();
    }
}
