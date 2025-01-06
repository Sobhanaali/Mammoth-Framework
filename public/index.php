<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\SiteController;
use app\core\Application;



$app = new Application(dirname(__DIR__));

$app->router->get('/' , 'home');

$app->router->get('/contact' , 'contact');

$app->router->post('/contact' , [SiteController::class , 'handleContent'] );

$app->run();