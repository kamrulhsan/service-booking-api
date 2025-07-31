<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingStatusUpdateRequest;
use App\Models\Booking;
use App\Services\v1\BookingService;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Booking",
 *     description="Booking Endpoints"
 * )
 */
class BookingsController extends Controller
{
    public $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    /**
     * @OA\Get(
     *     path="/api/admin/bookings",
     *     tags={"Booking"},
     *     summary="Get all bookings (Admin only)",
     *     @OA\Response(
     *         response=200,
     *         description="List of all bookings"
     *     )
     * )
     */
    public function index()
    {
        return $this->bookingService->all();
    }

    /**
 * @OA\Post(
 *     path="/bookings",
 *     tags={"Booking"},
 *     summary="Create a new booking",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"service_id", "booking_date", "status"},
 *             @OA\Property(property="service_id", type="integer", example=1),
 *             @OA\Property(property="booking_date", type="string", format="date", example="2025-08-01"),
 *             @OA\Property(property="status", type="string", example="pending")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Booking created successfully"
 *     )
 * )
 */
    public function store(BookingRequest $request)
    {
        return $this->bookingService->create($request->all());
    }

   /**
     * @OA\Get(
     *     path="/api/bookings/user",
     *     tags={"Booking"},
     *     summary="Get bookings for authenticated user",
     *     @OA\Response(
     *         response=200,
     *         description="List of user bookings"
     *     )
     * )
     */
    public function fetchByUser()
    {
        return $this->bookingService->fetchByUser();
    }

    /**
     * @OA\Patch(
     *     path="/api/bookings/{booking}/status",
     *     tags={"Booking"},
     *     summary="Update booking status (Admin Only)",
     *     @OA\Parameter(
     *         name="booking",
     *         in="path",
     *         required=true,
     *         description="Booking ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"status"},
    *             @OA\Property(property="status", type="string", example="pending")
        *     ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking status updated successfully"
     *     )
     * )
     */
    public function updateStatus(BookingStatusUpdateRequest $request, Booking $booking)
    {
        return $this->bookingService->updateStatus($request, $booking);
    }

   /**
     * @OA\Delete(
     *     path="/api/bookings/{booking}",
     *     tags={"Booking"},
     *     summary="Delete a booking",
     *     @OA\Parameter(
     *         name="booking",
     *         in="path",
     *         required=true,
     *         description="Booking ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking deleted successfully"
     *     )
     * )
     */
    public function destroy(Booking $booking)
    {
        return $this->bookingService->destroy($booking);
    }
}
