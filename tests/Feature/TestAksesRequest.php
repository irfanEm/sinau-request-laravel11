<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestAksesRequest extends TestCase
{
    public function testAkses()
    {
        $this->get('/closure-route')
            ->assertStatus(200)
            ->assertJson([
                "message" => "ini adalah path yang diambil dari object request : closure-route. yang diakses dengan method : GET."
            ]);
    }

    public function testAksesRequestController()
    {
        $this->get("/controller-method")
            ->assertStatus(200)
            ->assertJson([
                "message" => "ini adalah path yang diambil dari object request : controller-method. yang diakses dengan method : GET."
            ]);
    }

    public function testAksesRequestdanDependency()
    {
        $this->get("/controller-method/irfan")
            ->assertStatus(200)
            ->assertJson([
                "message" => "hai irfan method dari request-mu = GET, dan path-mu = controller-method/irfan"
            ]);
    }

    public function testPathUrlHost()
    {
        $this->get("/controller-path-method-request")
            ->assertStatus(200)
            ->assertJson([
                "message" => "ini adalah data dari Object request",
                "data" => [
                    "path" => "controller-path-method-request",
                    "urls" => [
                    "url" => "http://localhost/controller-path-method-request",
                    "fullUrl" => "http://localhost/controller-path-method-request",
                    "fullUrlWithQuery" => "http://localhost/controller-path-method-request?testing=nilaiTesting",
                    "fullUrlWithoutQuery" => "http://localhost/controller-path-method-request"
                    ],
                    "hosts" => [
                        "host1" => "localhost",
                        "host2" => "localhost",
                        "host3" => "http://localhost"
                    ],
                    "methods" => "GET",
                    "headers" => [
                    "header" => "I_EM",
                    "bearerToken" => null
                    ],
                    "ips" => [
                    "ip" => "127.0.0.1",
                    "ips" => [
                            "127.0.0.1"
                        ]
                    ]
                ]
            ]);
    }
}
