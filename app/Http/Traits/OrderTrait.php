<?php


namespace App\Http\Traits;
use Illuminate\Support\Facades\Http;

trait OrderTrait
{
    public function authenticateWithWakilni()
    {
        $wakilniApiUrl = env('WAKILNI_API_URL');
        $wakilniApiKey = env('WAKILNI_API_KEY');
        $wakilniApiSecret = env('WAKILNI_API_SECRET');

        $response = Http::get("$wakilniApiUrl/api/v2/third_party/auth_token", [
            'key' => $wakilniApiKey,
            'secret' => $wakilniApiSecret,
        ]);

        return $response->json();
    }

    public function startBulk($token)
    {
        return $this->makeWakilniRequest('POST', '/api/v2/clients/start_bulk', [
            'location_id' => 1,
            'longitude' => 123.456,
            'latitude' => 78.910,
            'floor' => 2,
            'area' => 'Sample Area',
        ], $token);
    }

    public function addDeliveryToWakilni($token, $bulkId, $deliveryData)
    {
        $url = "/api/v2/clients/add_delivery/{$bulkId}";


        // $requestData = [
        //     'get_order_details' => true,
        //     'get_barcode' => true,
        //     'waybill' => $deliveryData['waybill'],
        //     'receiver_id' => $deliveryData['receiver_id'],
        //     'receiver_first_name' => $deliveryData['receiver_first_name'],
        //     'receiver_last_name' => $deliveryData['receiver_last_name'],
        //     'receiver_phone_number' => $deliveryData['receiver_phone_number'],
        //     'receiver_gender' => $deliveryData['receiver_gender'],
        //     'receiver_email' => $deliveryData['receiver_email'],
        //     'receiver_secondary_phone_number' => $deliveryData['receiver_secondary_phone_number'],
        //     'receiver_location_id' => $deliveryData['receiver_location_id'],
        //     'receiver_longitude' => $deliveryData['receiver_longitude'],
        //     'receiver_latitude' => $deliveryData['receiver_latitude'],
        //     'receiver_building' => $deliveryData['receiver_building'],
        //     'receiver_floor' => $deliveryData['receiver_floor'],
        //     'receiver_directions' => $deliveryData['receiver_directions'],
        //     'receiver_area' => $deliveryData['receiver_area'],
        //     'currency' => $deliveryData['currency'],
        //     'cash_collection_type_id' => $deliveryData['cash_collection_type_id'],
        //     'collection_amount' => $deliveryData['collection_amount'],
        //     'note' => $deliveryData['note'],
        //     'car_needed' => $deliveryData['car_needed'],
        //     'packages' => $deliveryData['packages'],
        // ];


        return $this->makeWakilniRequest('POST', $url, $deliveryData, $token);
    }



    public function endBulk($token, $bulkId)
    {
        $url = "/api/v2/clients/end_bulk/{$bulkId}";
        return $this->makeWakilniRequest('POST', $url, [], $token);
    }

    public function showOrderStatus($token, $orderId)
    {
        $url = "/api/v2/clients/orders/{$orderId}";
        return $this->makeWakilniRequest('POST', $url, [], $token);
    }



    private function makeWakilniRequest($method, $url, $data, $token)
    {
        return Http::withHeaders([
            'Authorization' => "Bearer $token",
        ])->$method(env('WAKILNI_API_URL') . $url, $data)->json();
    }
}
