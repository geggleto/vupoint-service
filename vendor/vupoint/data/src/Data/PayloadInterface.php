<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 9:25 AM
 */

namespace Vupoint\Data;

interface PayloadInterface
{
    /**
     * @return array
     */
    public function getPayload();

    /**
     * @param array $payload
     */
    public function setPayload($payload);

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @param string $message
     */
    public function setMessage($message);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $status
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function toJson();
}