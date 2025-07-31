<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingStatusUpdateRequest;
use App\Models\Booking;
use App\Services\v1\BookingService;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->bookingService->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {
        return $this->bookingService->create($request->all());
    }

    public function fetchByUser()
    {
        return $this->bookingService->fetchByUser();
    }

    public function updateStatus(BookingStatusUpdateRequest $request, Booking $booking)
    {
        return $this->bookingService->updateStatus($request, $booking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        return $this->bookingService->destroy($booking);
    }
}
