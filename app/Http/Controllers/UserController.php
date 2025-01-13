<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function UserLogin(Request $request)
   {
    try {
        $userEmail=$request->UserEmail;
        $otp=rand(100000,999999)        ;
        $details=['code'=>$otp];
        Mail::to($userEmail)->send(new OtpMail($details));
        User::updateOrCreate(
            ['email'=>$userEmail],['email'=>$userEmail,'otp'=>$otp]
        );
        return ResponseHelper::out('success',"A 6 digit code has been sent to your email",200);
        
    } catch (Exception $e) {
        return ResponseHelper::out('fail',$e,200);
    }
   }
   public function VerifyLogin(Request $request)
   {
    
           $userEmail = $request->UserEmail;
           $otp = $request->OTP;
   
           // Find the user based on email and OTP, but also ensure OTP hasn't expired
           $user = User::where('email', $userEmail)
                       ->where('otp', $otp)                      
                       ->first();
   
           if ($user) {
               // OTP is valid, reset it (set it to '0' after use)
               User::where('email', $userEmail)->where('otp', $otp)->update(['otp' => '0']);
   
               // Generate a new authentication token for the user
               $tokenValue = $user->createToken('auth_token')->plainTextToken;
   
               // Return the success response with a token stored in a cookie
               return ResponseHelper::out('success', "Login Successfully", 200)
                   ->withCookie(cookie('token', $tokenValue, 60 * 24 * 30)); // 30 days expiration
           } else {
               // OTP is either invalid or expired
               return ResponseHelper::out('fail', "Invalid or Expired OTP", 401);
           }
        
   }

   public function UserLogout(Request $request)
   {
      return redirect('/userLoginPage')->cookie('token', null, -1);
       
   }

}
   

   

