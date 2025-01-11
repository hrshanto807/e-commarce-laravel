<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Helpers\ResponseHelper;

class BranController extends Controller
{
   public function BrandList():JsonResponse
   {
       $brand = Brand::all();
       return ResponseHelper::out('success',$brand,200);
   }


   
}
