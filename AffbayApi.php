<?php

namespace Affbay\AffbayApi;

class AffbayApi
{
    /**@var \Affbay\AffbayApi\Auth */
    protected $authenticator;
    
    const API_BASE = 'https://efirstpanel.com/api/';
    const API_ENDPOINT = [
        'single' => 'make/contact',
        'multi' => 'make/contacts',
    ];
    const METHOD = 'POST';
    
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const PHONE = 'phone';
    const EMAIL = 'email';
    const CLICK_ID = 'click_id';
    const SKU = 'product';
    
    static $contacts = [];
    static $token;
    
    /**
     * AffbayApi constructor.
     *
     * @param $token
     *
     * @throws \Affbay\AffbayApi\AffbayException
     */
    public function __construct($token) {
        
        $this->autoloader();
        
        $this->authenticator = new Auth($token);
        $this->sender = new Sender();
        
    }
    
    /**
     * Autoloader function
     * loads all dependencies
     */
    private function autoloader()
    {
        if(!class_exists(AffbayException::class)) require_once __DIR__ . '/classes/AffbayException.php';
        if(!class_exists(Auth::class)) require_once __DIR__ . '/classes/Auth.php';
        if(!class_exists(Contact::class)) require_once __DIR__ . '/classes/Contact.php';
        if(!class_exists(Sender::class)) require_once __DIR__ . '/classes/Sender.php';
        if(!class_exists('\GuzzleHttp\Client')) require_once __DIR__ . '/vendor/autoload.php';
    }
    
    /**
     * @return string
     */
    public function getToken()
    {
        return self::$token;
    }
    
    /**
     * @return array
     */
    public function getContacts()
    {
        return self::$contacts;
    }
    
    public function push()
    {
        return $this->sender->send();
    }
    
}