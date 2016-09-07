<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-06
 * Time: 1:57 PM
 */

namespace Vupoint\Api;


use Valitron\Validator;
use Vupoint\Data\Payload;
use Vupoint\Data\PayloadInterface;

/**
 * Class EmailService
 *
 * @package Vupoint\Service
 */
class EmailService implements EmailServiceInterface
{
    /** @var Payload  */
    protected $payload;

    /** @var Validator */
    protected $validator;

    /** @var \Swift_Mailer  */
    protected $mailer;

    /**
     * EmailService constructor.
     * @param PayloadInterface $payload
     * @param Validator $validator
     * @param \Swift_Mailer $mailer
     */
    public function __construct(PayloadInterface $payload, Validator $validator, \Swift_Mailer $mailer)
    {
        $this->payload = $payload;
        $this->validator = $validator;
        $this->mailer = $mailer;
    }

    /**
     * @param array $post
     * @return Payload
     */
    public function handleRequest(array $post = array()) {
        $this->validator->rule('required', ['to', 'from', 'subject', 'body']);
        $this->validator->rule('optional', ['cc', 'bcc']);
        $this->validator->rule('array', ['to', 'cc', 'bcc']);

        if ($this->validator->validate()) {
            $message = \Swift_Message::newInstance();
            $message->setTo($post['to']);
            $message->setFrom($post['from']);

            if (isset($post['cc'])) {
                $message->setCc($post['cc']);
            }

            if (isset($post['bcc'])) {
                $message->setBcc($post['bcc']);
            }

            $message->setSubject($post['subject']);
            $message->setBody($post['body']);
            $message->setContentType('text/html');

            if ($this->mailer->send($message)) {
                $this->payload->setMessage("Mail sent successfully");
                $this->payload->setStatus("true");
            } else {
                $this->payload->setMessage("Mail sent unsuccessfully");
            }
        } else {
            $this->payload->setMessage("Unable to process request, due to errors in the request");
            $this->payload->setPayload($this->validator->errors());
        }

        return $this->payload;
    }
}