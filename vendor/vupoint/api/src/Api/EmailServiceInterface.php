<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 9:25 AM
 */

namespace Vupoint\Api;

use Vupoint\Data\Payload;

/**
 * Class EmailService
 *
 * @package Vupoint\Service
 */
interface EmailServiceInterface
{
    /**
     * @param array $post
     * @return Payload
     */
    public function handleRequest(array $post = array());
}