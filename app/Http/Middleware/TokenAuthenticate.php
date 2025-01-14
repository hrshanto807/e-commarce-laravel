<?php
namespace App\Http\Middleware;
use App\Helpers\JWTToken;
use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class TokenAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $token=$request->cookie('token');
        $result=JWTToken::ReadToken($token);
        if($result=="unauthorized"){
            return ResponseHelper::Out('unauthorized',null,401);
        }
        else{
            $request->headers->set('email',$result->userEmail);
            $request->headers->set('id',$result->userID);
            return $next($request);
        }
    }
}
