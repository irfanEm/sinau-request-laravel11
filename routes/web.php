<?php

use App\Http\Controllers\InteraksiDenganRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// contoh object request pada route closure
Route::get('/closure-route', function(Request $request) {
    $path = $request->path();
    $method = $request->method();
    
    $response = [
        "message" => "ini adalah path yang diambil dari object request : $path. yang diakses dengan method : $method."
    ];
    
    return response()->json($response);
});

Route::get("/controller-method", [InteraksiDenganRequestController::class, "request"]);
Route::get("/controller-method/{id}", [InteraksiDenganRequestController::class, "requestDependency"]);
Route::get("/controller-path-method-request", [InteraksiDenganRequestController::class, "testPathUrlHost"]);

