<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-06
 * Time: 3:14 PM
 */

namespace Vupoint\Tests\Service;


use PHPUnit\Framework\TestCase;
use Valitron\Validator;
use Vupoint\Api\EmailService;
use Vupoint\Api\ExcelService;
use Vupoint\Data\Payload;
use \Mockery as m;


class ExcelServiceTest extends TestCase
{
    /**
     * @return array
     */
    public function makeData() {
        return [
            "name" => "test.xls",
            "sheets" => [
                [
                    "name" => "Sheet 1",
                    "data" => [
                        [
                            "ID",
                            "NAME",
                            "SCORE"
                        ],
                        [
                            rand(0,100),
                            "MIKE",
                            rand(0,100)
                        ],
                        [
                            rand(0,100),
                            "JIMMY",
                            rand(0,100)
                        ],
                        [
                            rand(0,100),
                            "GLENN",
                            rand(0,100)
                        ]
                    ],
                    "cols" => 3,
                    "rows" => 4
                ]
            ]
        ];
    }

    public function testExcelService() {
        $data = $this->makeData();

        $excelService = new ExcelService("/web", __DIR__ . "/../../cache", new Validator($data), new \PHPExcel());
        $payload = $excelService->handleRequest($data);


        $this->assertEquals("Operation successful", $payload->getMessage());
        $this->assertSame(["file" => "/web/".$data['name']], $payload->getPayload());
        $this->assertEquals("true", $payload->getStatus());
        $this->assertTrue(file_exists(__DIR__."/../../cache/test.xls"));
    }

    public function tearDown()
    {
        m::close();
    }
}