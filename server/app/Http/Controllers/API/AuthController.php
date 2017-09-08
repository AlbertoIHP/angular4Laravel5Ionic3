<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\AppBaseController;

class AuthController extends AppBaseController
{
	public function userAuth(Request $request) {

		error_log("Obteniendo datos de la peticion");
		// grab credentials from the request
		error_log($request);
		$credentials = $request->only('email', 'password');

		try {
			// attempt to verify the credentials and create a token for the user
			error_log("Verificando existencia del token");
			if (! $token = JWTAuth::attempt($credentials)) {

				error_log("Las credenciales son invalidas");
				return response()->json(['error' => 'invalid_credentials'], 401);
			}
		} catch (JWTException $e) {
			// something went wrong whilst attempting to encode the token
			error_log("Error no documentado");
			return response()->json(['error' => 'could_not_create_token'], 500);
		}

		error_log("Retornando token");
		// all good so return the token
		return response()->json(compact('token'));
	}
}