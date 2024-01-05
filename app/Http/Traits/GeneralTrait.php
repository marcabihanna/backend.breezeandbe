<?php

namespace App\Http\Traits;

use App\Models\ContactDetail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

trait GeneralTrait
{
    public function apiResponse($data = null, bool $status = true, $error = null, $statusCode = 200)
    {
        $array = [
            'data' => $data,
            'status' => $status,
            'error' => $error,
            'statusCode' => $statusCode
        ];
        return response($array, $statusCode);
    }

    public function unAuthorizeResponse()
    {
        return $this->apiResponse(null, 0, 'Unauthorize', 401);
    }

    public function notFoundResponse($more)
    {
        return $this->apiResponse(null, 0, $more, 404);
    }

    public function requiredField($message)
    {
        // return $this->apiResponse(null, false, $message, 200);
        return $this->apiResponse(null, false, $message, 400);
    }

    public function send_email(MailerInterface $mailer, $templateName, $email1, $subj, $order)
    {
        try {
            $email = (new Email())
            ->from($_ENV['MAIL_FROM_ADDRESS'])
            ->to($email1)
            ->replyTo($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME'])
            ->subject($subj)
            ->html('<h1>Your Order Details</h1>' . $order);

            $transport = (new \Symfony\Component\Mailer\Transport\Smtp\SmtpTransport(
                $_ENV['MAIL_HOST'],
                $_ENV['MAIL_PORT'],
                $_ENV['MAIL_ENCRYPTION']
            ))
                ->setUsername($_ENV['MAIL_USERNAME'])
                ->setPassword($_ENV['MAIL_PASSWORD']);

            $mailer->send($email, $transport);

            return true;
        } catch (\Exception $e) {
            // Handle exception as needed
            return false;
        }
    }
}
