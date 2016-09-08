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
 * Interface ServiceInterface
 *
 * @package Vupoint\Api
 */
interface ServiceInterface
{
    /**
     * @param array $post
     * @return Payload
     */
    public function handleRequest(array $post = array());
}