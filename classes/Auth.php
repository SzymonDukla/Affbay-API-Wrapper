<?php

namespace Affbay\AffbayApi;

class Auth extends AffbayApi
{
    
    public function __construct($token) {
        
        if(!class_exists(AffbayApi::class)) {
            throw new AffbayException("AffbayApi class not loaded", 500);
        }
        
        parent::$token = $token;
    }
    
}