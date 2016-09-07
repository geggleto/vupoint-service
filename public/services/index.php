<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-06
 * Time: 11:24 AM
 */
include __DIR__. "/../../vendor/autoload.php";

$app = new \RKA\Slim();

include __DIR__ . "/../../config/config.php";

$app->post('/email', 'Vupoint\Controller\EmailAction:handle');

$app->run();