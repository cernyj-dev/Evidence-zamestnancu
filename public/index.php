<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__ . '/template');
$twig = new Environment($loader);

$router = new App\Router($twig);

echo $router->process($_GET);
