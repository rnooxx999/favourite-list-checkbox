<?php

namespace App\Traits;
use Tymon\JWTAuth\Facades\JWTAuth;

use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\Request;

trait UserTrait
{

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function jsonCheckUserUnauthorized($user ,$lang){
           
        if (!$user ) {
            return response()->json([
                "status" => 'error',
               "message" =>  $lang === 'en' ? 
               'you are Unauthorized' : 'غير مصرح به',
            "response"=> Response::HTTP_UNAUTHORIZED]);
        }

        return true;
    }

    public function userAuthJWT()
    {

        $lang = 'ar';
        try {

            //$user = auth()->user();
            $user = JWTAuth::parseToken()->authenticate();

            // التحقق من  صحة وجود اليوزر
            $jsonCheckUserUnauthorized = $this->jsonCheckUserUnauthorized($user, $lang);
            if ($jsonCheckUserUnauthorized !== true) {
                return response()->json($jsonCheckUserUnauthorized, 400);
            }
            return $user;
        }
        catch (AuthenticationException $e) {
            return
                [
                    "status" => 'error',
                    "message" => $lang === 'ar' ?
                        'غير مصرح به' : 'you are Unauthorized'
                        ,400
                ]
            ;
        } catch (JWTException $e) {
            // قم بمعالجة الأخطاء الأخرى المتعلقة بالرمز المميز
            return
                [
                    "status" => 'error',
                    "message" => $lang === 'ar' ?
                        'تم انتهاء صلاحية دخولك' : 'Token expired. Please log in again.',
                    400
                ];
            
        }
    }

}