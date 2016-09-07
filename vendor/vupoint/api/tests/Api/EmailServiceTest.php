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
use Vupoint\Data\Payload;
use \Mockery as m;


class EmailServiceTest extends TestCase
{
    /**
     * @return \Swift_Mailer
     */
    public function makeMailer() {
        $service = m::mock('Swift_Mailer');
        $service->shouldReceive('send')->times(1)->andReturn(true);
        return $service;
    }

    /**
     * @return array
     */
    public function makeData() {
        return [
            'to' => ["geggleto@gmail.com"],
            'from' => 'glenn.eggleton@vupointsystems.ca',
            'cc' => ['glenn.eggleton@vupointsystems.ca'],
            'subject' => "Automated Test Email Service",
            'body' => "Automaited test email service test email"
        ];
    }

    public function testEmailService() {
        $emailService = new EmailService(new Payload(), new Validator($this->makeData()), $this->makeMailer());
        $payload = $emailService->handleRequest($this->makeData());

        $this->assertEquals("Mail sent successfully", $payload->getMessage());
        $this->assertSame([], $payload->getPayload());
        $this->assertEquals("true", $payload->getStatus());
    }

    public function tearDown()
    {
        m::close();
    }
}