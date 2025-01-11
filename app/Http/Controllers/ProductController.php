<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\ProductSlider;
use Illuminate\Http\JsonResponse;
use App\Models\ProductDetail;
use App\Models\ProductReview;

class ProductController extends Controller
{
    
   function ProductListByCategory(Request $request){
   $data = Product::where('category_id',$request->id)->with('brand')->with('category')->get();
   return ResponseHelper::out('success',$data,200);
   }



//    
   function ProductListByBrand(Request $request){
   $data = Product::where('brand_id',$request->id)->with('brand')->with('category')->get();
   return ResponseHelper::out('success',$data,200);
   }
// 
   function ProductListByRemark(Request $request){
   $data = Product::where('remark',$request->remark)->with('brand')->with('category')->get();
   return ResponseHelper::out('success',$data,200);
   }
// 
   function ProductListBySlider(Request $request){
   $data = ProductSlider::all();
   return ResponseHelper::out('success',$data,200);
   }
// 

   public function ProductDetailsById(Request $request):JsonResponse{

    $data=ProductDetail::where('product_id',$request->id)->with('product','product.brand','product.category')->get();

    return ResponseHelper::Out('success',$data,200);
}
// 
   function ProductListByReview(Request $request):JsonResponse{
   $data = ProductReview::where('product_id',$request->id)->with(['profile'=>function($query){$query->select('id','cus_name');}])->get();
   return ResponseHelper::out('success',$data,200);
   }   
}
