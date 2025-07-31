<?php

namespace App\Services\v1;

use App\Models\Service;

class ServiceService
{

    public function all()
    {
        $services = Service::active()->select('id', 'name', 'price', 'status')->get();

        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }
    public function create($data)
    {
        $service = Service::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Service created successfully',
            'data' => $service
        ], 201);
    }

    public function show($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update($data, $service)
    {
        $service->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully',
            'data' => $service
        ]);
    }

    public function destroy($service)
    {
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully'
        ]);
    }
}