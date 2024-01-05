<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public function code(Request $request)
    {
        try {
            $couponCode = $request->code;
            if (!empty($couponCode)) {
                $coupon = Coupon::where('code', $couponCode)->first();
                if (!$coupon) {
                    return $this->apiResponse(['message' => 'Coupon not found'], false, 'Coupon not found', 404);
                }

                $data['discount'] = $coupon->discount;
                return $this->apiResponse($data);
            } else {
                return $this->requiredField('code is required');
            }

        } catch (\Exception $e) {
            return $this->apiResponse(null, false, $e->getMessage(), 500);
        }
    }
}
