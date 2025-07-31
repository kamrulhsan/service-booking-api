<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Services\v1\ServiceService;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Services",
 *     description="Service Management Endpoints"
 * )
 */

class ServiceController extends Controller
{
    public $services;

    public function __construct(ServiceService $service)
    {
        $this->services = $service;
    }
   /**
     * @OA\Get(
     *     path="/services",
     *     tags={"Services"},
     *     summary="Get all active services list",
     *     @OA\Response(
     *         response=200,
     *         description="List of services",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Basic Cleaning"),
     *                     @OA\Property(property="price", type="number", format="float", example=100.00),
     *                     @OA\Property(property="status", type="string", example="active")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return $this->services->all();
    }

     /**
     * @OA\Post(
     *     path="/services",
     *     tags={"Services"},
     *     summary="Create a new service (Admin Only)",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "price", "status"},
     *             @OA\Property(property="name", type="string", example="Premium Wash"),
     *             @OA\Property(property="price", type="number", format="float", example=150.00),
     *             @OA\Property(property="status", type="string", example="active")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Service created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Service created successfully"),
     *         )
     *     )
     * )
     */
    public function store(ServiceRequest $request)
    {
        return $this->services->create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/services/{service}",
     *     tags={"Services"},
     *     summary="Get a specific service (Admin Only)",
     *     @OA\Parameter(
     *         name="service",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service details",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data")
     *         )
     *     )
     * )
     */
    public function show(Service $service)
    {
        return $this->services->show($service);
    }


    /**
     * @OA\Put(
     *     path="/services/{service}",
     *     tags={"Services"},
     *     summary="Update an existing service (Admin Only)",
     *     @OA\Parameter(
     *         name="service",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "price", "status"},
     *             @OA\Property(property="name", type="string", example="Updated Wash"),
     *             @OA\Property(property="price", type="number", format="float", example=180.00),
     *             @OA\Property(property="status", type="string", example="inactive")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Service updated successfully"),
     *             @OA\Property(property="data")
     *         )
     *     )
     * )
     */
    public function update(ServiceRequest $request, Service $service)
    {
        return $this->services->update($request->all(), $service);
    }

    /**
     * @OA\Delete(
     *     path="/services/{service}",
     *     tags={"Services"},
     *     summary="Delete a service (Admin Only)",
     *     @OA\Parameter(
     *         name="service",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Service deleted successfully")
     *         )
     *     )
     * )
     */
    public function destroy(Service $service)
    {
        return $this->services->destroy($service);
    }
}
