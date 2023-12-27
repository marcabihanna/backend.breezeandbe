<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\ContactDetailResource;
use App\Http\Resources\FooterResource;
use App\Http\Resources\PageComponentResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\RealStoreResource;
use App\Http\Resources\SliderResource;
use App\Http\Traits\GeneralTrait;
use App\Models\ContactDetail;
use App\Models\Footer;
use App\Models\PageComponent;
use App\Models\Product;
use App\Models\RealStore;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    Use GeneralTrait;
    public function index()
    {
        try {
            $latestProduct = Product::where('status', 1)->latest()->first();

            $allProducts = ProductResource::collection(Product::where('status', 1)
                ->whereNotIn('id', [$latestProduct->id])
                ->get());
            $slider = SliderResource::collection(Slider::where('page', 'home')->get());
            $topDescription =new PageComponentResource(PageComponent::where('page', 'home')->where('slug', 'top_home_description')->first());
            $topDescription2 =new PageComponentResource(PageComponent::where('page', 'home')->where('slug', 'top_home_description2')->first());
            // $allProducts = ProductResource::collection(Product::where('status', 1)->get());
            $call_to_action = new PageComponentResource(PageComponent::where('page', 'home')->where('slug', 'call_to_action')->first());
            $realStories = RealStoreResource::collection(RealStore::all());
            $call_to_action2 =  new PageComponentResource(PageComponent::where('page', 'home')->where('slug', 'call_to_action2')->first());
            $contact = ContactDetailResource::collection(ContactDetail::all());
            $footer=FooterResource::collection(Footer::all());

            return $this->apiResponse([
                'slider' => $slider,
                'top_description' => $topDescription,
                'top_description2' => $topDescription2,
                'all_products' => $allProducts,
                'call_to_action' => $call_to_action,
                'title_testimonial' => $realStories,
                'call_to_action2' => $call_to_action2,
                'contact' => $contact,
                'footer' => $footer,
                'latestProduct'=> new ProductResource($latestProduct),
            ]);
        } catch (\Exception $e) {
            return $this->apiResponse(null, false, $e->getMessage(), 500);
        }
    }
}
