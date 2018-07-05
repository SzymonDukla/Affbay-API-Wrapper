<?php

namespace Affbay\AffbayApi;

class Contact extends AffbayApi
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $click_id;
    public $product;
    
    public function __construct($parameters = [], $product = false) {
        
        if(!class_exists(AffbayApi::class)) {
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
    
        $this->first_name   = $parameters[parent::FIRST_NAME] ?? '';
        $this->last_name    = $parameters[parent::LAST_NAME] ?? '';
        $this->email        = $parameters[parent::EMAIL] ?? '';
        $this->phone        = $parameters[parent::PHONE] ?? '';
        $this->click_id     = $parameters[parent::CLICK_ID] ?? '';
    
        $this->product      = $product;
        
    }
    
    public function setFirstName($value)
    {
        return $this->first_name = $value;
    }
    
    public function setLastName($value)
    {
        return $this->first_name = $value;
    }
    
    public function setPhone($value)
    {
        return $this->first_name = $value;
    }
    
    public function setEmail($value)
    {
        return $this->email = $value;
    }
    
    public function setClickId($value)
    {
        return $this->click_id = $value;
    }
    
    public function setProduct($value)
    {
        return $this->product = $value;
    }

    public function get()
    {
        return [
            parent::FIRST_NAME => $this->first_name,
            parent::LAST_NAME => $this->last_name,
            parent::PHONE => $this->phone,
            parent::EMAIL => $this->email,
            parent::CLICK_ID => $this->click_id,
            parent::SKU => $this->product,
        ];
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
