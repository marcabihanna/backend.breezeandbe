<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageComponentResource;
use App\Http\Traits\GeneralTrait;
use App\Models\PageComponent;
use Illuminate\Http\Request;

class Page6Controller extends Controller
{
    Use GeneralTrait;
    public function index()
    {
        try {
            $overview = PageComponentResource::collection(PageComponent::where('page','six')->where('slug','overview')->get());
            $allComponents = PageComponentResource::collection(PageComponent::where('page','six')->where('slug','section')->get());

            return $this->apiResponse(['overview' => $overview, 'all_section' => $allComponents]);
        } catch (\Exception $e) {
            return $this->apiResponse(null, false, $e->getMessage(), 500);
        }
    }
}
