<?php 

namespace App\Helpers;

class ResponseHelper{
    public static function out($msg,$data,$code){
        return response()->json([
            'msg' => $msg,
            'data' => $data,            
        ],$code);
    }
}