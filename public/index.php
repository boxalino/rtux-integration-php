<?php
use Symfony\Component\HttpFoundation\Request;
use BoxalinoClientProject\BoxalinoIntegration\Kernel;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Dotenv\Dotenv;

$loader = require __DIR__.'/../vendor/autoload.php';
// auto-load annotations
AnnotationRegistry::registerLoader([$loader, 'loadClass']);
(new Dotenv(true))->load(__DIR__ . '/../.env');

$kernel = new Kernel('dev', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);