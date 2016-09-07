<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-06
 * Time: 1:53 PM
 */

namespace Vupoint\Data;

class Payload implements PayloadInterface
{
    protected $payload;
    protected $message;
    protected $status;

    public function __construct()
    {
        $this->payload = array();
        $this->message = "";
        $this->status = "false";
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param array $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function toJson() {
        return json_encode([
            "payload" => $this->payload,
            "status" => $this->status,
            "message" => $this->message
        ]);
    }

    public function __toString()
    {
        return $this->toJson();
    }

}