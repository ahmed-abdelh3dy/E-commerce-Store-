<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokenController extends Controller
{

    
    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email|max:255',
        'password' => 'required|string|max:255',
        'device_name' => 'string|max:255',
        'abilities' => 'nullable|string'
    ]);

    $user = User::where('email', $request->email)->first();
    if ($user && Hash::check($request->password, $user->password)) {
        $device_name = $request->post('device_name', $request->userAgent());


        $abilities = $request->post('abilities') ? explode(',', $request->post('abilities')) : ['products.create','products.update'];
        $token = $user->createToken($device_name, $abilities);

        return Response::json([
            'token' => $token->plainTextToken,
            'user' => $user
        ]);
    }

    return Response::json([
        'message' => 'not working'
    ]);
}


    public function destroy($token = null){
        $user= Auth::guard('sanctum')->user();

        if($token === null){
            $user->currentAccessToken()->delete();
            return [
                'message' => 'yes go'

            ];
        }

        $userToken = PersonalAccessToken::findToken($token);
        if($user->id == $userToken->tokenable_id && get_class($user) == $userToken->tokenable_type ){
            $userToken->delete();
        }
    }
}
