<?php

namespace Affbay\AffbayApi;

class Client
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
        $this->authenticator = new Auth($token);
        $this->sender = new Sender();
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
        try {
            return $this->sender->send();
        } catch (AffbayException $exception)
        {
            return $exception->getMessage();
        }
    }
    
}