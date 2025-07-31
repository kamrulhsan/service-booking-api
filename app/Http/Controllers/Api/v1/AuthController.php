<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\{
    LoginRequest,
    RegistrationRequest
};
use App\Services\v1\AuthService;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public $authservice;
    public function __construct(AuthService $authService)
    {
        $this->authservice = $authService;
    }

    public function register(RegistrationRequest $request)
    {
        return $this->authservice->register($request->all());
    }

    public function login(LoginRequest $request)
    {
        return $this->authservice->login($request->all());
    }

    public function adminLogin(LoginRequest $request)
    {
        return $this->authservice->adminlogin($request->all());
    }

    public function logout()
    {
        return $this->authservice->logout();
    }
}
