<?php

namespace Affbay\AffbayApi;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class Sender extends AffbayApi
{
    
    private $client;
    private $endpoint;
    private $entries;
    private $response;
    
    public function __construct() {
        if(!class_exists(AffbayApi::class)) {
            throw new AffbayException("AffbayApi class not loaded", 500);
        }

        
        $this->client = new Client([
            'base_uri' => parent::API_BASE,
            'timeout'  => 600,
        ]);
        
    }
    
    private function request()
    {
        $promise = $this->client->requestAsync(parent::METHOD, $this->endpoint, [ 'json' => $this->entries ])
            ->then(
                function (ResponseInterface $res) {
                    $this->response = $res->getBody()->getContents();
                },
                function (RequestException $e) {
                    throw new AffbayException($e->getMessage(), $e->getCode());
                }
            );
    
        $promise->wait();
    
        return $promise->getState();
    }
    
    public function send()
    {
        $list = parent::$contacts;
        $count = count($list);
        if( $count > 0 ) {
            if( $count < 25 ) {
                //  Single
                if( $count == 1) {
                    $this->endpoint = parent::API_ENDPOINT['single'];
                } else if( $count >= 2 ) {
                    $this->endpoint = parent::API_ENDPOINT['multi'];
                } else {
                    throw new AffbayException("Unexpected error occurred.",107);
                }
            } else {
                throw new AffbayException("You can send up to 25 contacts at a time.",106);
            }
        } else {
            throw new AffbayException("Contacts list is empty",105);
        }
        
        //  Prepare data
        if($this->endpoint == parent::API_ENDPOINT['multi']) {
            $list_a = $list;
            $list = [];
            $list['contacts'] = $list_a;
            unset($list_a);
        } else {
            $list = $list[0];
        }
        
        //  Add token
        $list['token'] = parent::$token;
        
        //  Push to proper variable
        $this->entries = $list;
        
        //  Send data
        $request = $this->request();
        
        //  Check response
        if( $request == 'fulfilled' ) {
            return $this->response;
        }
        
        throw new AffbayException("Error when making request");
        
    }
}