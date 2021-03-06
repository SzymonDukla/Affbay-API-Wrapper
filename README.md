#   Affbay API Wrapper
API Version: 2.1

Documentation https://affbay.asia/documentation

#### Table of contents
- [About](#about)
- [Requirements](#requirements)
- [Endpoints](#endpoints)
- [Installation Instructions](#installation-instructions)
- [File Tree](#file-tree)
- [Opening an Issue](#opening-an-issue)

### About
A PHP wrapper for [Affbay API v2](https://affbay.asia) allows you to create and send leads.

### Requirements
* Composer
* Web server with PHP 7.X.X

### Token
Prior you can create any lead (contact) you need to create and account and generate a token:

1. Visit https://affbay.asia/register
2. Select ```Make me API user``` and fill the form with your details
3. Once you have your account, click on your user name in the navigation and proceed to ```Settings```
4. Switch page to ```API Tokens``` and generate your token for ```efirstpanel.com```
5. You're good to go!

### Endpoints
Currently only two endpoints are supported:

* ```/make/contact``` - creating single contact
* ```/make/contacts``` - bulk creation of up to 25 contacts

Endpoints require different data structure. Thankfully to this wrapper *you DO NOT need to specify or even care about that*. Simply add one or more contacts by creating new instances of ```Contact()``` class and stash them. When pushing your list to Affbay the script will automatically detect and adjust data structure and choose proper endpoint.

### Installation Instructions
1. Install the package via composer `composer require affbay/affbay-api-wrapper`
2. Include Composer's autoload class into your project and add required ```use``` declaration, i.e.
```php
<?php

use Affbay\Client;
use Affbay\Contact;
use Affbay\AffbayException;

require_once( __DIR__ . /vendor/autoload.php);

...
```
3. Initiate the library with ```$affbay = new Client( 'your-token-here' )```
4. Create a new contact by creating a new instance of ```Contact()``` class (see the example script) with properties:
```        
'first_name' => 'Joe',
'last_name' => 'Doe',           // optional
'phone' => '1234567890',
'email' => 'joe@example.com',   // optional
'click_id' => '12345'
```
5. You need to pass `product` parameter containing desired product SKU. You can pass it within parameters when creating each ```Contact()``` object or use ```setProduct()``` method on Contact() class instance.
5. Stash newly created contact using ```stash()``` method
6. You can create up to ```25``` contacts at a time, remember to add them to the stash
6. Once you are ready, push stashed contacts using ```push()``` method
```
$result = $affbay->push();
print_r($result);
```
12. Check out example script in ```example/index.php```

### File Tree
```
affbay-api-wrapper
├── example
│   ├── second-phone
│   │    └── index.php
│   ├── with-lp
|   │    ├── assets
│   │    |      ├── css
│   │    |      ├── images
│   │    ├── index.html
│   │    ├── middle-script.php
│   └── index.php
├── src
│   ├── AffbayException.php
│   ├── Auth.php
│   ├── Contact.php
│   ├── Sender.php
│   └── Client.php
├── .gitignore
├── README.md
└── composer.json
```

### Opening an Issue
Before opening an issue there are a couple of considerations:
* If you did not **star this repo** *We will close the issue immediately without consideration.*
* **Read the instructions** and make sure all steps were *followed correctly*.
* **Check** that the issue is not *specific to the development environment* setup.
* **Provide** *duplication steps*.
* **Attempt to look into the issue**, and if you *have a solution, make a pull request*.
* **Show that you have made an attempt** to *look into the issue*.
* **Check** to see if the issue you are *reporting is a duplicate* of a previous reported issue.
* **Follow these instructions and show us that you have tried.**
* If you have a questions or comments don't hesitate to [give us a shout](https://affbay.asia/contact)!
