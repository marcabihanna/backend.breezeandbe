<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactDetailResource;
use App\Http\Resources\FooterResource;
use App\Http\Resources\PageComponentResource;
use App\Http\Resources\SliderResource;
use App\Http\Traits\GeneralTrait;
use App\Models\ContactDetail;
use App\Models\Footer;
use App\Models\PageComponent;
use App\Models\Slider;
use Illuminate\Http\Request;

class Page1Controller extends Controller
{
    Use GeneralTrait;
    public function index()
    {
        try {
            $slider =SliderResource::collection(Slider::where('page', 'first')->get());
            $meetTheFounder = new PageComponentResource(PageComponent::where('page', 'first')->where('slug', 'meet_the_founder')->first());
            $ourStory =new PageComponentResource(PageComponent::where('page', 'first')->where('slug', 'our_story')->first());
            $contact = ContactDetailResource::collection(ContactDetail::all());
            $footer=FooterResource::collection(Footer::all());

            return $this->apiResponse([
                'slider' => $slider,
                'meet_the_founder' => $meetTheFounder,
                'our_story' => $ourStory,
                'contact' => $contact,
                'footer' => $footer
            ]);
        } catch (\Exception $e) {
            return $this->apiResponse(null, false, $e->getMessage(), 500);
        }
    }
}
