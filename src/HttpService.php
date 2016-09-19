<?php

/**
 * Copyright © 2015 Mozg. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Mozg\Loggi;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client as HttpClient;

class HttpStatus
{
    const Ok = 200;
    const Created = 201;
    const BadRequest = 400;
    const NotFound = 404;
}

class HttpService
{

    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var HttpClient
     */
    protected $http;

    /**
     * @var array
     */
    protected $debugData  = array();

    /**
     * ApiService constructor.
     * @param array $options
     */
    function __construct($options = [])
    {

        $this->debugData[] = __METHOD__;

        $this->config = $options;

        $this->headers = $this->config['headers'];
    }

    public function __destruct()
    {

        $this->debugData[] = __METHOD__;

        $_array = $this->debugData;

        //\Zend\Debug\Debug::dump($_array);
    }

    /**
     * @param -
     * @return -
     * @throws \Exception
     */
    public function execute($parameters)
    {

        $this->debugData[] = __METHOD__;

        $method = 'POST';
        $uri = $this->config['apiUri'];
        $options = [
            'body' => \json_encode($parameters),
            'headers' => $this->headers
        ];

        $this->debugData[][__LINE__]['method'] = $method;
        $this->debugData[][__LINE__]['uri'] = $uri;
        $this->debugData[][__LINE__]['options'] = $uri;

        try {

            $response = $this->http()->request($method, $uri, $options);

            $this->debugData[][__LINE__]['response'] = $response;

            $result = \json_decode($response->getBody()->getContents(), true);

            $this->debugData[][__LINE__]['result'] = $result;

        } catch (RequestException $e) {

            $result = array(
                'code'=>$e->getCode(),
                'message'=>$e->getMessage()
                );

            $this->debugData[][__LINE__]['exception'] = $e->getMessage();
        }

        return $result;
    }

    /**
     * @return HttpClient
     */
    protected function http()
    {

        $this->debugData[] = __METHOD__;

        if (!$this->http) {
            $this->http = new HttpClient();
        }
        return $this->http;
    }


}
