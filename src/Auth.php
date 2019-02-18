<?php

namespace Affbay\AffbayApi;

class Auth extends Client
{
    
    public function __construct($token) {
        
        if(!class_exists(Client::class)) {
            throw new AffbayException("AffbayApi class not loaded", 500);
        }
        
        parent::$token = $token;
    }
    
}