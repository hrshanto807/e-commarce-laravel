<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\ProductSlider;
use Illuminate\Http\JsonResponse;
use App\Models\ProductDetail;
use App\Models\ProductReview;
use App\Models\CustomerProfile;
use App\Models\ProductWish;
use App\Models\ProductCart;

class ProductController extends Controller
{
   // page controller

   public function ByCategory(){

      return view ('pages.product-by-category');      
   }
   public function ByBrand(){

      return view ('pages.product-by-brand');      
   }

   public function ProductDetailsPage(){
      return view('pages.details-page');
   }

   public function ProductCartPage(){
      return view('pages.cart-list-page');
   }
   public function ProductWishPage(){
      return view('pages.wish-list-page');
   }
   
   
   
   
   
   
   
   
   
   //  product category
   function ProductListByCategory(Request $request){
   $data = Product::where('category_id',$request->id)->with('brand')->with('category')->get();
   return ResponseHelper::out('success',$data,200);
   }



// product brand   
   function ProductListByBrand(Request $request){
   $data = Product::where('brand_id',$request->id)->with('brand')->with('category')->get();
   return ResponseHelper::out('success',$data,200);
   }
// product remark
   function ProductListByRemark(Request $request){
   $data = Product::where('remark',$request->remark)->with('brand')->with('category')->get();
   return ResponseHelper::out('success',$data,200);
   }
// product slider
   function ProductListBySlider(Request $request){
   $data = ProductSlider::all();
   return ResponseHelper::out('success',$data,200);
   }
// product details

   public function ProductDetailsById(Request $request):JsonResponse{

    $data=ProductDetail::where('product_id',$request->id)->with('product','product.brand','product.category')->get();

    return ResponseHelper::Out('success',$data,200);
}
// product review
   function ProductListByReview(Request $request):JsonResponse{
   $data = ProductReview::where('product_id',$request->id)->with(['profile'=>function($query){$query->select('id','cus_name');}])->get();
   return ResponseHelper::out('success',$data,200);
   }  
   
 
   public function CreateProductReview(Request $request){
      $user_id=$request->header('id');
      $profile=CustomerProfile::where('user_id',$user_id)->first();
      if($profile){
        $request->merge(['customer_id' =>$profile->id]);
        $data= ProductReview::updateOrCreate(
            ['customer_id' => $profile->id,'product_id'=>$request->product_id],
            $request->input()
        );
        return ResponseHelper::Out('success',$data,200);
      }
      else{
        return ResponseHelper::Out('fail',"customer not found",401);
      }

   }
// product wish list
   public function ProductWishList(Request $request){
      $user_id=$request->header('id');
      $data= ProductWish::where('user_id',$user_id)->with('product')->get();
      return ResponseHelper::Out('success',$data,200);
     
   }

   public function CreateWishList(Request $request){
      $user_id=$request->header('id');      
      $data= ProductWish::updateOrCreate(
          ['user_id' => $user_id,'product_id'=>$request->product_id],
          $request->input()
      );
      return ResponseHelper::Out('success',$data,200);
   }

   public function RemoveWishList(Request $request){
      $user_id=$request->header('id');
      $data= ProductWish::where(['user_id'=>$user_id,'product_id'=>$request->product_id])->delete();
      return ResponseHelper::Out('success',$data,200);
   }

   // product cart
   public function ProductCartList(Request $request){
      $user_id=$request->header('id');
      $data= ProductCart::where('user_id',$user_id)->with('product')->get();
      return ResponseHelper::Out('success',$data,200);
     
   }

   public function CreateCartList(Request $request){
      $user_id=$request->header('id');
      $product_id=$request->product_id;
      $color=$request->input('color');
      $size=$request->input('size');
      $qty=$request->input('qty');

      $UnitPrice=0;

      $productDetail=Product::where('id',$product_id)->first();

      if($productDetail->discount==1){
        $UnitPrice=$productDetail->discount_price;
      }
      else{
        $UnitPrice=$productDetail->price;
      }
     $totalPrice=$UnitPrice*$qty;

      $data= ProductCart::updateOrCreate(
          [
         'user_id' => $user_id,
         'product_id'=>$product_id,
         'color'=>$color,'size'=>$size,
         'qty'=>$qty,
         'price'=>$totalPrice
          ] 
          );
      return ResponseHelper::Out('success',$data,200);
   }     

   public function RemoveCartList(Request $request){
      $user_id=$request->header('id');
      $data= ProductCart::where(['user_id'=>$user_id,'product_id'=>$request->product_id])->delete();    
      return ResponseHelper::Out('success',$data,200);
   }


}
