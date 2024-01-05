<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageComponentResource;
use App\Http\Traits\GeneralTrait;
use App\Models\PageComponent;
use Illuminate\Http\Request;

class Page5Controller extends Controller
{
    Use GeneralTrait;
    public function index()
    {
        try {
            $privacyPolicy = PageComponentResource::collection(PageComponent::where('page','five')->where('slug','privacy_policy')->get());

            return $this->apiResponse(['privacy_policy' => $privacyPolicy]);
        } catch (\Exception $e) {
            return $this->apiResponse(null, false, $e->getMessage(), 500);
        }
    }
}
