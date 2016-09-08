<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 10:40 AM
 */

//Load App Variables
$env = new Dotenv\Dotenv(__DIR__."/../");
$env->load();

$app->container->singleton('mailer', function ($c) {
    $transport = \Swift_SmtpTransport::newInstance(getenv('EMAIL_HOST'), getenv('EMAIL_PORT'))
        ->setUsername(getenv('EMAIL_USERNAME'))
        ->setPassword(getenv('EMAIL_PASSWORD'));
    return \Swift_Mailer::newInstance($transport);
});

$app->container->singleton('validator', function ($c) use ($app) {
    return new Valitron\Validator($app->request()->post());
});

$app->container->singleton('payload', function ($c) use ($app) {
    return new \Vupoint\Data\Payload();
});

$app->container->singleton('excel', function ($c) use ($app) {
    return new \PHPExcel();
});
