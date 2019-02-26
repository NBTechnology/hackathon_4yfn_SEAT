<?php
include __DIR__ . "/vendor/autoload.php";
//USE Polyline;
$encoded = "sdq{Fc}iLj@zR|W~TryCzvC??do@jkKeiDxjIccLhiFqiE`uJqe@rlCy~B`t@sK|i@";

$points = Polyline::decode($encoded);

// print_r($points);



$requestContent = array(
    
);

$options = array('http' =>
                    array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/json',  
                        'content' => json_encode($requestContent)  
                    )
                );

$context = stream_context_create($options);
$response = file_get_contents('https://europe-west1-metropolis-fe-test.cloudfunctions.net/api/trips');
$response = json_decode($response, true);
$routesEncrypt = array();
$routesDecrypt = array();
foreach ($response as $key => $value) {
    array_push($routesEncrypt, $value['route']);
}

foreach ($routesEncrypt as $key => $value) {
    array_push($routesDecrypt,Polyline::decode($value));
}
// echo "<pre>";
// print_r($routesDecrypt);
// exit;

require('./index.view.php');
?>