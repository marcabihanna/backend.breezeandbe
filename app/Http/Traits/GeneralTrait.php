<?php

namespace App\Http\Traits;

use App\Models\ContactDetail;
use Illuminate\Support\Facades\Mail;

trait GeneralTrait
{
    public function apiResponse($data = null, bool $status = true, $error = null, $statusCode = 200)
    {
        $array = [
            'data' => $data,
            'status' => $status ,
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


    public function send_email($templateName, $email1, $subj, $order)
    {
        try {


            Mail::send($templateName, $order, function ($message) use ($email1, $subj) {
                $message->to($email1, 'Insurance')->subject($subj);
                // $message->from('biners.testing@gmail.com', 'Insurance');
            });

            return true;
        } catch (\Swift_TransportException $e) {
            if ($e->getMessage()) {
                return "catch";
            }
        }
    }

}


