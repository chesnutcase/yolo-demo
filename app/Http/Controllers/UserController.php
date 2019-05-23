<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Handles the endpoint to register a user.
     *
     * @param Illuminate\Http\Request
     * @param mixed $request
     *
     * @return Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required', //what is the "password" validation rule you specified?
            'age' => 'required',
        ]);
        $fields = $request->all(['first_name', 'last_name', 'email', 'password', 'age']);
        $fields['password'] = Hash::make($request->input('password'));
        User::create($fields);

        return response()->json(['status' => 'ok']);
    }

    /**
     * Logins the user and dispense a password token.
     *
     * Actually the logging in itself is done by the middleware, we just issue a token here
     *
     * @param mixed $request
     */
    public function login(Request $request)
    {
        // logging in has been done by the middleware
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);
        $client = new \GuzzleHttp\Client([
            'base_uri' => getenv('APP_URL'),
            'http_errors' => false,
        ]);
        $path = '/api/oauth/token';
        $response = $client->post($path, [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $request->input('client_id'),
                'client_secret' => $request->input('client_secret'),
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'scope' => '',
            ],
        ]);

        return response()->json(json_decode((string) $response->getBody()));
    }
    
    public function getDetails(Request $request, $id){
      if($id == $request->user("api")->id){
        return response()->json(json_decode($request->user("api")));
      }else{
        return response()->json(["status" => "error", "description" => "unauthorized: you can only retrieve your own profile"], 401);
      }
    }
}
