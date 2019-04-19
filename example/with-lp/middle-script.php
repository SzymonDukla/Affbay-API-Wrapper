<?php

use Affbay\Client;
use Affbay\Contact;
use Affbay\AffbayException;

//  Define your landing page
define('YOUR_LANDING_PAGE', 'http://icons.iconarchive.com/icons/atyourservice/service-categories/256/Amazing-icon.png');
define('API_TOKEN', 'YOUR API TOKEN HERE GENERATE IT ON AFFBAY.COM');

//  Check whether request was made via POST method
if( $_POST ) {
    
    //  Some validation
    
    if(
        !isset($_POST['product']) || $_POST['product'] == ''
    ) {
        return die("Data missing!");
    }
    
    //  As we don't pass click_id within form data
    //  we need to generate it
    //  but let's check if it's not passed for sure
    if(!isset($_POST['click_id']) || $_POST['click_id'] != '') {
        $click_id = hash('tiger192,3', date('Y-m-d H:i:s'));
    } else {
        $click_id = $_POST['click_id'];
    }
    
    try {
    
        //  Load Affbay API wrapper file
        require __DIR__ . '/../../vendor/autoload.php';
        
        //  Pass your API token here
        $affbay = new Client(API_TOKEN);
        
        //  You can explode joint name to first_name and last_name
        //  but this is completely optional step as the API can
        //  accept just first_name parameter
        $name = explode(' ', $_POST['name']);
        
        /*
         * Create new contact
         */
        $contact = new Contact([
            'first_name' => $name[0],
            'last_name' => $name[1],
            'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
            'email' => isset($_POST['email']) ? $_POST['email'] : '',
            'click_id' => isset($_POST['click_id']) ? $_POST['click_id'] : '',
        ]);
        //  Set product SKU (you can do it also by passing `product` with SKU as a value in parameters array when
        // creating Contact instance
        //  In this example we're passing this value directly from the form data, but you can just define it here with
        //  a variable or in any other way
        $contact->setProduct($_POST['product']);
        //  Stash newly created contact and prepare it to dispatch
        $contact->stash();
        
        /*
         * Send contact to Affbay
         */
        
        $result = json_decode($affbay->push());
        
        /*
         * Check results
         */
        
        if( isset( $result->id ) )
        {
            header('Location: ' . YOUR_LANDING_PAGE);
        } else {
            
            die( "Error: " . $result->status );
            
        }
        
    } catch (AffbayException $e) {
        print $e->getMessage();
    }
    
}