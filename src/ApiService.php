<?php

/**
 * Copyright © 2015 Mozg. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Mozg\Cielo;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client as HttpClient;

class HttpStatus
{
    const Ok = 200;
    const Created = 201;
    const BadRequest = 400;
    const NotFound = 404;
}

class ApiService
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
    public function authorize($parameters)
    {

        $this->debugData[] = __METHOD__;

        $method = 'POST';
        $uri = $this->config['apiUri'] . '/sales/';
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
     * Gets a sale
     * @param string $paymentId
     * @return mixed
     */
    public function get($paymentId)
    {

        $this->debugData[] = __METHOD__;

        $method = 'GET';
        $uri = $this->config['apiQueryUri'] . \sprintf('/sales/%s', $paymentId);
        $options = [
            'headers' => $this->headers
        ];

        $this->debugData[][__LINE__]['method'] = $method;
        $this->debugData[][__LINE__]['uri'] = $uri;
        $this->debugData[][__LINE__]['options'] = $uri;

        try {

            $response = $this->http()->request($method, $uri, $options);

            $this->debugData[][__LINE__]['response'] = $response;

            $result = \json_decode($response->getBody()->getContents(), true);            

            if ($response->getStatusCode() === HttpStatus::Ok) {
                return $result;
            } elseif ($response->getStatusCode() == HttpStatus::BadRequest) {
                return 'status_codex';
            }

        } catch (\Exception $e) {

            $result = array(
                'code'=>$e->getCode(),
                'message'=>$e->getMessage()
                );

            $this->debugData[][__LINE__]['exception'] = $e->getMessage();

        }

        return $result;
    }

    /**
     * Captures a pre-authorized payment
     * @param string $paymentId
     * @param array $captureRequest
     * @return mixed
     */
    public function capture($paymentId, $captureRequest)
    {

        $this->debugData[] = __METHOD__;

        
        if (!$paymentId) {
            throw new \InvalidArgumentException('$paymentId é obrigatório');
        }

        $method = 'PUT';
        $uri = $this->config['apiUri'] . \sprintf('/sales/%s/capture', $paymentId);
        $options = [
            'headers' => $this->headers
        ];
        
        if ($captureRequest) {
            $uri .= '?' . \http_build_query($captureRequest);
        }

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
     * Void a payment
     * @param string $paymentId
     * @param int $amount
     * @return mixed
     */
    public function void($paymentId, $amount)
    {

        $this->debugData[] = __METHOD__;

        $method = 'PUT';
        $uri = $this->config['apiUri'] . \sprintf('/sales/%s/void', $paymentId);
        $options = [
            'headers' => $this->headers
        ];

        if ($amount) {
            $uri .= sprintf('?amount=%s', (float)$amount);
        }

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
