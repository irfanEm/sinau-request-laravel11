<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InteraksiDenganRequestController extends Controller
{
    public function request(Request $request)
    {
        $method = $request->method();
        $path = $request->path();

        $response = [
            "message" => "ini adalah path yang diambil dari object request : $path. yang diakses dengan method : $method."
        ];
        return response()->json($response);
    }

    public function requestDependency(Request $request, string $id)
    {
        $method = $request->method();
        $path = $request->path();
        $sid = $id;

        $response = [
            "message" => "hai $sid method dari request-mu = $method, dan path-mu = $path"
        ];

        return response()->json($response);

    }

    public function testPathUrlHost(Request $request)
    {
        $path = $request->path();
        if($request->is("controller-method/isMethod")) {
            return response()->json(["message" => "ini diverifikasi dengan method is pada object request"]);
        }
        
        if($request->routeIs('admin.*')){
            return response()->json(["message" => "ini diverifikasi dengan method routeIs() pada object request"]);
        }

        // mengambil data URL
        $url = $request->url();
        $fullUrl = $request->fullUrl();
        $fullUrlWithQuery = $request->fullUrlWithQuery(['testing' => 'nilaiTesting']);
        $fullUrlWithoutQuery = $request->fullUrlWithoutQuery('testing');

        // mengambil data HOST
        $host = $request->host();
        $host2 = $request->httpHost();
        $host3 = $request->schemeAndHttpHost();

        // mengambil data METHOD
        $method = $request->method();
        if($request->isMethod("post")){
            return response()->json(["message" => "method ini diakses dengan method POST."]);
        }

        // mengakses data HEADER
        $header = $request->header("X-HEADER-IRFANM", "I_EM");
        $token = $request->bearerToken();

        // mengakses data IP
        $ip = $request->ip();
        $ips = $request->ips();
        
        return response()->json([
            "message" => "ini adalah data dari Object request",
            "data" => [
                "path" => $path,
                "urls" => [
                    "url" => $url, 
                    "fullUrl" => $fullUrl,
                    "fullUrlWithQuery" => $fullUrlWithQuery,
                    "fullUrlWithoutQuery" => $fullUrlWithoutQuery
                ],
                "hosts" => [
                    "host1" => $host,
                    "host2" => $host2,
                    "host3" => $host3,
                ],
                "methods" => $method,
                "headers" => [
                    "header" => $header,
                    "bearerToken" => $token,
                ],
                "ips" => [
                    "ip" => $ip,
                    "ips" => $ips,
                ]
            ]
        ]);
    }
}
