<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 12:38 PM
 */
namespace Vupoint\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

interface ActionInterface
{
    /**
     * @return \Slim\Slim
     */
    public function getApp();

    /**
     * @param \Slim\Slim $app
     */
    public function setApp($app);

    /**
     * @return Request
     */
    public function getRequest();

    /**
     * @param Request $request
     */
    public function setRequest($request);

    /**
     * @return Response
     */
    public function getResponse();

    /**
     * @param Response $response
     */
    public function setResponse($response);

    /**
     * @param array ...$args
     * @return void
     */
    public function handle(... $args);
}