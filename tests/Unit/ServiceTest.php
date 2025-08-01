<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\v1\ServiceController;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Services\v1\ServiceService;
use Mockery;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    protected $serviceService;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->serviceService = Mockery::mock(ServiceService::class);
        $this->controller = new ServiceController($this->serviceService);
    }

    public function test_index_returns_all_services()
    {
        $expectedServices = [
            [
                'id' => 1,
                'name' => 'Basic Cleaning',
                'price' => 100.00,
                'status' => 'active'
            ]
        ];

        $this->serviceService->shouldReceive('all')
            ->once()
            ->andReturn($expectedServices);

        $response = $this->controller->index();
        $this->assertEquals($expectedServices, $response);
    }

    public function test_store_creates_new_service()
    {
        $serviceData = [
            'name' => 'Premium Wash',
            'price' => 150.00,
            'status' => 'active'
        ];

        $expectedResponse = [
            'success' => true,
            'message' => 'Service created successfully'
        ];

        $request = Mockery::mock(ServiceRequest::class);
        $request->shouldReceive('all')
            ->once()
            ->andReturn($serviceData);

        $this->serviceService->shouldReceive('create')
            ->with($serviceData)
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->store($request);
        $this->assertEquals($expectedResponse, $response);
    }

    public function test_show_returns_specific_service()
    {
        $service = new Service([
            'id' => 1,
            'name' => 'Basic Cleaning',
            'price' => 100.00,
            'status' => 'active'
        ]);

        $expectedResponse = [
            'success' => true,
            'data' => $service
        ];

        $this->serviceService->shouldReceive('show')
            ->with($service)
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->show($service);
        $this->assertEquals($expectedResponse, $response);
    }

    public function test_destroy_deletes_service()
    {
        $service = new Service(['id' => 1]);
        $expectedResponse = [
            'success' => true,
            'message' => 'Service deleted successfully'
        ];

        $this->serviceService->shouldReceive('destroy')
            ->with($service)
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->destroy($service);
        $this->assertEquals($expectedResponse, $response);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
