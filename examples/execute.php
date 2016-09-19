<?php

/**
 * Copyright © 2016 Mozg. All rights reserved.
 * See LICENSE.txt for license details.
 */

$path = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
$fileName = $path . "/vendor/autoload.php";
//echo $fileName;
require_once($fileName);

/*
echo ('<h2>spl_autoload_functions()</h2>');
\Zend\Debug\Debug::dump(spl_autoload_functions());
exit;
*/


// 19/09/2016
// http://api.docs.dev.loggi.com/

use Mozg\Loggi\ApiService;

//

$waypoints[] = [
    'by' => 'cep',
    'query' => [
        'cep' => '05135400',
        'number' => '77',
        'instructions' => 'Retirar pacote 182 com Maria.'
    ]
];
$waypoints[] = [
'by' => 'cep',
    'query' => [
        'cep' => '08215430',
        'number' => '182',
        'instructions' => 'Deixar pacote 182 com José.'
    ]
];

$request = [
    'city' => '1',
    'package_type' => 'box',
    'payment_method' => '808',
    'transport_type' => '1',
    'slo' => '1',
    'waypoints' => $waypoints
];

$service_production = [
    'headers' => [
        'Content-Type' => 'application/json;charset=UTF-8',
        'Authorization' => 'ApiKey [email da conta]:[chave da API da conta]'
    ],
    'apiUri' => 'https://loggi.com/api/v1/endereco/orcamento/'
];

$service_sandbox = [
    'headers' => [
        'Content-Type' => 'application/json;charset=UTF-8',
        'Authorization' => 'ApiKey [email da conta]:[chave da API da conta]'
    ],
    'apiUri' => 'https://staging.loggi.com/api/v1/endereco/orcamento/'
];

$service = $service_sandbox;

//

echo '<h2>request</h2>';
//\Zend\Debug\Debug::dump($service);
echo '<h2>array</h2>';
\Zend\Debug\Debug::dump($request);
echo '<h2>json</h2>';
\Zend\Debug\Debug::dump(\json_encode($request));

echo '<h2>ApiService->orcamento</h2>';

$service = new ApiService($service);
$response = $service->execute($request);

//

echo '<h2>response</h2>';

\Zend\Debug\Debug::dump($response);