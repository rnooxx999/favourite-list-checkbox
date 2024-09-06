<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserForGameResource;
use Illuminate\Http\Request;
use App\Http\Resources\UserForApiResource;
use App\Models\user;
use App\Traits\UserTrait;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\ProfileRequestForApi;
use App\Http\Requests\PasswordRequestForApi;

class UserApiController extends Controller
{
   
    use UserTrait;


   
}