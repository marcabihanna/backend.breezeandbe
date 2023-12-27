<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactDetailResource;
use App\Http\Resources\FooterResource;
use App\Http\Resources\PageComponentResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductTitleResource;
use App\Http\Traits\GeneralTrait;
use App\Models\ContactDetail;
use App\Models\Footer;
use App\Models\PageComponent;
use App\Models\Product;
use Illuminate\Http\Request;

class Page3Controller extends Controller
{
    Use GeneralTrait;
    public function show(Request $request)
    {
        try {
            $product = new ProductResource(Product::where('uuid',$request->uuid)->first());
            $allProducts = ProductTitleResource::collection(Product::where('status', 1)
            ->whereNotIn('uuid', [$request->uuid])->get());
            $call_to_action = new PageComponentResource(PageComponent::where('page', 'third')->where('slug', 'call_to_action')->first());
            $contact = ContactDetailResource::collection(ContactDetail::all());
            $footer=FooterResource::collection(Footer::all());

            return $this->apiResponse([
                'product' => $product,
                'all_products' => $allProducts,
                'call_to_action' => $call_to_action,
                'contact' => $contact,
                'footer' => $footer
            ]);
        } catch (\Exception $e) {
            return $this->apiResponse(null, false, $e->getMessage(), 500);
        }
    }
}
