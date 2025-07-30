<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Services\v1\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public $services;

    public function __construct(ServiceService $service)
    {
        $this->services = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->services->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        return $this->services->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return $this->services->show($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service)
    {
        return $this->services->update($request->all(), $service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        return $this->services->destroy($service);
    }
}
