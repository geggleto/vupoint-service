<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 10:36 AM
 */

namespace Vupoint\Controller;


use Slim\Http\Request;
use Slim\Http\Response;
use Vupoint\Api\EmailService;

class EmailAction implements ActionInterface
{
    /** @var \Slim\Slim */
    protected $app;

    /** @var Request */
    protected $request;

    /** @var Response */
    protected $response;


    /**
     * @return \Slim\Slim
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param \Slim\Slim $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }


    public function handle(... $args) {
        $handler = new EmailService(
            $this->app->payload,
            $this->app->validator,
            $this->app->mailer
        );

        print $handler->handleRequest($this->request->post());
    }
}