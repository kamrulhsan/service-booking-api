<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Services\v1\AuthService;
use Mockery;
use Tests\TestCase;

class AuthTest extends TestCase
{
    protected $authService;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = Mockery::mock(AuthService::class);
        $this->controller = new AuthController($this->authService);
    }

    public function test_register_creates_new_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $expectedResponse = [
            'success' => true,
            'message' => 'User registered successfully',
            'token' => 'sample-token'
        ];

        $request = Mockery::mock(RegistrationRequest::class);
        $request->shouldReceive('all')
            ->once()
            ->andReturn($userData);

        $this->authService->shouldReceive('register')
            ->with($userData)
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->register($request);
        $this->assertEquals($expectedResponse, $response);
    }

    public function test_login_authenticates_user()
    {
        $credentials = [
            'email' => 'john@example.com',
            'password' => '123456'
        ];

        $expectedResponse = [
            'success' => true,
            'token' => 'sample-token',
            'user' => [
                'name' => 'John Doe',
                'email' => 'john@example.com'
            ]
        ];

        $request = Mockery::mock(LoginRequest::class);
        $request->shouldReceive('all')
            ->once()
            ->andReturn($credentials);

        $this->authService->shouldReceive('login')
            ->with($credentials)
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->login($request);
        $this->assertEquals($expectedResponse, $response);
    }

    public function test_admin_login_authenticates_admin()
    {
        $credentials = [
            'email' => 'admin@example.com',
            'password' => 'admin123'
        ];

        $expectedResponse = [
            'success' => true,
            'token' => 'admin-token',
            'user' => [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'role' => 'admin'
            ]
        ];

        $request = Mockery::mock(LoginRequest::class);
        $request->shouldReceive('all')
            ->once()
            ->andReturn($credentials);

        $this->authService->shouldReceive('adminlogin')
            ->with($credentials)
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->adminLogin($request);
        $this->assertEquals($expectedResponse, $response);
    }

    public function test_logout_ends_user_session()
    {
        $expectedResponse = [
            'success' => true,
            'message' => 'Successfully logged out'
        ];

        $this->authService->shouldReceive('logout')
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->logout();
        $this->assertEquals($expectedResponse, $response);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
