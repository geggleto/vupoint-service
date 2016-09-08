<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 4:03 PM
 */

namespace Vupoint\Controller;


use Slim\Http\Request;
use Slim\Http\Response;
use Valitron\Validator;
use Vupoint\Api\ExcelService;

class ExcelAction implements ActionInterface
{
    /** @var \Slim\Slim */
    protected $app;

    /** @var  Request */
    protected $request;

    /** @var  Response */
    protected $response;

    /** @var string */
    protected $webUri;

    /** @var string */
    protected $fileUri;

    /**
     * ExcelAction constructor.
     * @param $webUri
     * @param $fileUri
     */
    public function __construct($webUri, $fileUri)
    {
        $this->webUri = $webUri;
        $this->fileUri = $fileUri;
    }

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

    /**
     * @param array ...$args
     * @return void
     */
    public function handle(... $args)
    {
        $service = new ExcelService($this->webUri, $this->fileUri, $this->app->validator, $this->app->excel);
        $payload = $service->handleRequest($this->request->post());
        print $payload;
    }
}