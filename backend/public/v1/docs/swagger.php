<?php

require __DIR__ . '/../../../vendor/autoload.php';

define('BASE_URL', "http://localhost/Final 2024 BLANK/Final 2024 BLANK/backend/rest/");

error_reporting(0);

$openapi = \OpenApi\Generator::scan(['../../../rest', './'], ['pattern' => '*.php']);
// $openapi = \OpenApi\Util::finder(['../../../rest/routes', './'], NULL, '*.php');
// $openapi = \OpenApi\scan(['../../../rest', './'], ['pattern' => '*.php']);

header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
?>