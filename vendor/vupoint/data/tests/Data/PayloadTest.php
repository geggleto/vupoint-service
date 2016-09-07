<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 8:36 AM
 */

namespace Vupoint\Tests\Data;

use \Mockery as m;

use PHPUnit\Framework\TestCase;
use Vupoint\Data\Payload;

class PayloadTest extends TestCase
{
    public function testPayload() {
        $payload = new Payload();
        $payload->setMessage("a");
        $payload->setPayload("b");
        $payload->setStatus("c");

        $json = $payload->toJson();
        $json2 = [
            "payload" => "b",
            "status" => "c",
            "message" => "a"
        ];

        $this->assertSame(json_encode($json2), $json);
    }


    public function tearDown()
    {
        m::close();
    }
}