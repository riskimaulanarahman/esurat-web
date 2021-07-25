<?php

namespace App\Http\Middleware;

use Closure;
use Storage;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->module == "login")
        {
            $data = [
                "email" => $request->email,
            ];
            Storage::disk('public')->put('email.json', json_encode($data));
        }


        $path = storage_path() . "/app/public/email.json";

        $json = json_decode(file_get_contents($path), true); 


        return $next($request)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('email', $json['email'])
        ->header('Access-Control-Allow-Headers', '*')
        ->header('Access-Control-Expose-Headers', '*');
        // ->header('role', $role);

        // ->header('Access-Control-Allow-Methods', '*')
        // ->header('Access-Control-Allow-Headers', '*');
        // header("Access-Control-Allow-Origin: *");

        // // ALLOW OPTIONS METHOD
        // $headers = [
        //     'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
        //     'Access-Control-Allow-Headers'=> 'Content-Type, X-XSRF-Token, Authorization'
        // ];
        // if($request->getMethod() == "OPTIONS") {
        //     // The client-side application can set only headers allowed in Access-Control-Allow-Headers
        //     return Response::make('OK', 200, $headers);
        // }

        // $response = $next($request);
        // foreach($headers as $key => $value)
        //     $response->header($key, $value);
        // return $response;
    }
}
