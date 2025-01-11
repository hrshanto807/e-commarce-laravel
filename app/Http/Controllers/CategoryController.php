<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function CategoryList():JsonResponse
    {
        $brand = Category::all();
        return ResponseHelper::out('success',$brand,200);
    }
 
}
