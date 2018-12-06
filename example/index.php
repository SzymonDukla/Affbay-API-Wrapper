<?php

use Affbay\AffbayApi\AffbayApi;
use Affbay\AffbayApi\Contact;
use Affbay\AffbayApi\AffbayException;

require_once __DIR__ . '/../../vendor/autoload.php';

try {
    
    $affbay = new AffbayApi('abcabcabc123');
    
    /*
     * Create new contact
     */
    $contact = new Contact([
        'first_name' => 'Joe',
        'last_name' => 'Doe',
        'phone' => '1234567890',
        'email' => 'joe@example.com',
        'click_id' => '12345'
    ]);
    //  Set product SKU (you can do it also by passing `product` with SKU as a value in parameters array when
    // creating Contact instance
    $contact->setProduct('a47f1278-9c3c-4551-91b2-b8f7dc526f81');
    //  Stash newly created contact and prepare it to dispatch
    $contact->stash();
    
    /*
     * Send contact to Affbay
     */
    
    $result = $affbay->push();
    
    /*
     * Show results
     */
    print_r($result);
    
} catch (AffbayException $e) {
    print $e->getMessage();
}