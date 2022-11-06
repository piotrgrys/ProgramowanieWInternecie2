<?php

namespace SoapClient\Soap;

use Laminas\Soap\Client as SoapClient;

class Client extends SoapClient
{
    public function __construct($uri = null, $options = null)
    {
        $uri = 'http://localhost:8080/pi2/Lab2/pi2/public/soap-server/wsdl';

        parent::__construct($uri, $options);
    }


}