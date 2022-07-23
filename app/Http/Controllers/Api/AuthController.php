<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController  extends ApiController
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return $this->prepareResponse(Self::CODE_UNAUTHORIZED,'validation error','',$validateUser->errors());
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return $this->ok('User Created Successfully',$user->createToken("API TOKEN")->plainTextToken);

        } catch (\Throwable $th) {
            return $this->prepareResponse(Self::CODE_INTERNAL_SERVER_ERROR,$th->getMessage());
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return $this->prepareResponse(Self::CODE_UNAUTHORIZED,'validation error','',$validateUser->errors());
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return $this->prepareResponse(Self::CODE_UNAUTHORIZED,'Email & Password does not match with our record.');
            }

            $user = User::where('email', $request->email)->first();

            return $this->ok('User Logged In Successfully',$user->createToken("API TOKEN")->plainTextToken);

        } catch (\Throwable $th) {
            return $this->prepareResponse(Self::CODE_INTERNAL_SERVER_ERROR,$th->getMessage());
        }
    }
}
