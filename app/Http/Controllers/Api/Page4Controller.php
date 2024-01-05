<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactDetailResource;
use App\Http\Resources\FooterResource;
use App\Http\Resources\HowToUseResource;
use App\Http\Resources\PageComponentResource;
use App\Http\Resources\ProductTitleResource;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\OrderTrait;
use App\Models\ContactDetail;
use App\Models\Coupon;
use App\Models\Footer;
use App\Models\HowToUse;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PageComponent;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\OrderConfirmationEmail;
use Illuminate\Support\Facades\Mail;

class Page4Controller extends Controller
{
    use GeneralTrait;
    use OrderTrait;
    public function index()
    {
        try {
            $latestProduct = Product::where('status', 1)->latest()->first();

            $allProducts = ProductTitleResource::collection(Product::where('status', 1)
                ->whereNotIn('id', [$latestProduct->id])
                ->get());
            // $allProducts = ProductTitleResource::collection(Product::where('status', 1)->get());
            $call_to_action = PageComponentResource::collection(PageComponent::where('page', 'four')->where('slug', 'call_to_action')->get());
            $contact = ContactDetailResource::collection(ContactDetail::all());
            $how_to_use = HowToUseResource::collection(HowToUse::all());
            $footer = FooterResource::collection(Footer::all());
            return $this->apiResponse([

                'all_products' => $allProducts,
                'call_to_action' => $call_to_action,
                'contact' => $contact,
                'how_to_use' => $how_to_use,
                'footer' => $footer,
                'latestProduct' => new ProductTitleResource($latestProduct),
            ]);
        } catch (\Exception $e) {
            return $this->apiResponse(null, false, $e->getMessage(), 500);
        }
    }

    public function addOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'prefix_phone' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'address' => 'required|string',
            'products' => 'required|array',
            'products.*.uuid' => 'required|string',
            'products.*.quantity' => 'required|integer|min:1',
            'total_price_new' => 'nullable|numeric',
            'total_price' => 'required|numeric',
            'coupon_code' =>  'nullable|exists:coupons,code'
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        $products = Product::whereIn('uuid', array_column($request->products, 'uuid'))->get();

        $totalPriceNew = $request->input('total_price_new');
        if (count($products) !== count($request->products)) {
            return $this->notFoundResponse('One or more products not found.');
        }
        if (!empty($request->coupon_code)) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if (!$coupon) {
                return $this->apiResponse(['error' => 'Coupon not found'], false, null, 404);
            }
        }


        // $totalPrice = 0;
        // foreach ($products as $product) {
        //     $productData = collect($request->products)->where('uuid', $product->uuid)->first();
        //     $totalPrice += $product->price * $productData['quantity'];
        // }


        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'prefix_phone' => $request->prefix_phone,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'total_price_new' => ($totalPriceNew) ? $totalPriceNew : null,
            'status' => true,
            'delivered' => false,
            'in_progress' => true,
            'coupon_id' => $request->coupon_code ? $coupon->id : null,

        ]);


        foreach ($products as $product) {
            $productData = collect($request->products)->where('uuid', $product->uuid)->first();
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $productData['quantity'],
                'status' => true,
            ]);

            $productQuantities[$product->id] = $productData['quantity'];
        }


        $authResponse = $this->authenticateWithWakilni();

        if (isset($authResponse['token'])) {
            $wakilniToken = $authResponse['token'];
            $bulkResponse = $this->startBulk($wakilniToken);

            if (isset($bulkResponse['bulk_id'])) {

                $wakilniToken = $authResponse['token'];
                // $productQuantities[$product->id] = ($productQuantities[$product->id] ?? 0) + $productData['quantity'];

                $packages = [];
                foreach ($productQuantities as $productId => $quantity) {
                    $product = Product::find($productId);

                    $packages[] = [
                        'quantity' => $quantity,
                        'type_id' => $productId,
                        'name' => $product->title,
                        'sku' => 'SKU' . $productId,
                    ];
                }

                $fullName = $request->name;
                $parts = explode(' ', $fullName);

                $deliveryData = [
                    'get_order_details' => false,
                    'get_barcode' => false,
                    'waybill' => $order->id,
                    'receiver_id' => $order->id,
                    'receiver_first_name' => $parts[0],
                    'receiver_last_name' => implode(' ', array_slice($parts, 1)),
                    'receiver_phone_number' => $request->prefix_phone + $request->phone,
                    'receiver_gender' => '',
                    'receiver_email' => $request->email,
                    'receiver_secondary_phone_number' => '',
                    'receiver_location_id' => $order->id,
                    'receiver_longitude' => 0.0,
                    'receiver_latitude' => 0.0,
                    'receiver_building' => $request->address,
                    'receiver_floor' => 1,
                    'receiver_directions' => $request->address,
                    'receiver_area' => $request->city,
                    'currency' => 1,
                    'cash_collection_type_id' => 52,
                    'collection_amount' => $totalPriceNew ?? $request->total_price,
                    'note' => '',
                    'car_needed' => false,
                    'packages' => $packages,
                ];


                $wakilniResponse = $this->addDeliveryToWakilni($wakilniToken, $bulkResponse['bulk_id'], $deliveryData);

                if (isset($wakilniResponse['delivery_id'])) {

                    $endBulkResponse = $this->endBulk($wakilniToken, $bulkResponse['bulk_id']);

                    if (isset($endBulkResponse['bulk_id'])) {
                        Mail::to($order->email)->send(new OrderConfirmationEmail($order));

                        return $this->apiResponse(['order_uuid' => $order->uuid], true, null, 201);
                    } else {
                        return $this->apiResponse(['error' => 'Failed to end bulk with Wakilni API'], false, null, 500);
                    }
                } else {
                    return $this->apiResponse(['error' => 'Failed to add delivery with Wakilni API'], false, null, 500);
                }
            } else {
                return $this->apiResponse(['error' => 'Failed to start bulk with Wakilni API'], false, null, 500);
            }
        } else {
            return $this->apiResponse(['error' => 'Failed to authenticate with Wakilni API'], false, null, 500);
        }
    }
}
