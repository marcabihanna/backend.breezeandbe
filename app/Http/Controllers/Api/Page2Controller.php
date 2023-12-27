<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\ContactDetailResource;
use App\Http\Resources\FooterResource;
use App\Http\Resources\PageComponentResource;
use App\Http\Resources\ProductTitleResource;
use App\Http\Resources\SliderResource;
use App\Http\Traits\GeneralTrait;
use App\Models\ContactDetail;
use App\Models\Footer;
use App\Models\PageComponent;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class Page2Controller extends Controller
{
    Use GeneralTrait;
    public function index()
    {
        try {
            $slider = SliderResource::collection(Slider::where('page', 'second')->get());
            $allProducts = ProductTitleResource::collection(Product::where('status', 1)->get());
            $call_to_action = PageComponentResource::collection(PageComponent::where('page', 'second')->where('slug', 'call_to_action')->get());
            $contact = ContactDetailResource::collection(ContactDetail::all());
            $footer=FooterResource::collection(Footer::all());

            return $this->apiResponse([
                'slider' => $slider,
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
