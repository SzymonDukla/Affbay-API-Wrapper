<?php

namespace Affbay;

class Contact extends Client
{
    public $data;
    
    public function __construct($parameters = []) {
        
        if(!class_exists(Client::class)) {
            throw new AffbayException("AffbayApi class not loaded", 500);
        }
        if(!in_array(parent::FIRST_NAME, array_keys($parameters))) {
            throw new AffbayException('first_name must be explicitly provided', 500);
        }
        if(!in_array(parent::PHONE, array_keys($parameters)) && !in_array(parent::EMAIL, array_keys($parameters))) {
            throw new AffbayException('phone OR email must be explicitly provided', 500);
        }
        if(!in_array(parent::CLICK_ID, array_keys($parameters))) {
            throw new AffbayException('click_id must be explicitly provided', 500);
        }
    
        $this->data = $parameters;
        
    }

    public function get()
    {
        return $this->data;
    }
    
    public function stash()
    {
        $contact = $this->get();
        
        if($contact[parent::SKU] == false || !in_array(parent::SKU, array_keys($contact)) || !$contact)
        {
            throw new AffbayException("Product SKU must be explicitly provided. Pass it within parameters array or use Contact::setProduct() method.", 100);
        }
        
        parent::$contacts[] = $contact;
    }
    
}
