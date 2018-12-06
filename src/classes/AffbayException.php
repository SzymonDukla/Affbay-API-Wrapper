<?php

namespace Affbay\AffbayApi;

use Throwable;

class AffbayException extends \Exception
{
    
    function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    
}