<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\v1\BookingsController;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingStatusUpdateRequest;
use App\Models\Booking;
use App\Services\v1\BookingService;
use Mockery;
use Tests\TestCase;

class BookingTest extends TestCase
{
    protected $bookingService;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bookingService = Mockery::mock(BookingService::class);
        $this->controller = new BookingsController($this->bookingService);
    }

    public function test_index_returns_all_bookings()
    {
        $expectedBookings = [
            [
                'id' => 1,
                'service_id' => 1,
                'booking_date' => '2025-08-01',
                'status' => 'pending'
            ]
        ];

        $this->bookingService->shouldReceive('all')
            ->once()
            ->andReturn($expectedBookings);

        $response = $this->controller->index();
        $this->assertEquals($expectedBookings, $response);
    }

    public function test_store_creates_new_booking()
    {
        $bookingData = [
            'service_id' => 1,
            'booking_date' => '2025-08-01',
            'status' => 'pending'
        ];

        $expectedResponse = new Booking($bookingData);

        $request = Mockery::mock(BookingRequest::class);
        $request->shouldReceive('all')
            ->once()
            ->andReturn($bookingData);

        $this->bookingService->shouldReceive('create')
            ->with($bookingData)
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->store($request);
        $this->assertEquals($expectedResponse, $response);
    }

    public function test_fetch_by_user_returns_user_bookings()
    {
        $expectedBookings = [
            [
                'id' => 1,
                'user_id' => 1,
                'service_id' => 1,
                'booking_date' => '2025-08-01'
            ]
        ];

        $this->bookingService->shouldReceive('fetchByUser')
            ->once()
            ->andReturn($expectedBookings);

        $response = $this->controller->fetchByUser();
        $this->assertEquals($expectedBookings, $response);
    }

    public function test_update_status_updates_booking_status()
    {
        $booking = new Booking(['id' => 1]);
        $request = Mockery::mock(BookingStatusUpdateRequest::class);
        
        $expectedResponse = [
            'success' => true,
            'message' => 'Booking status updated successfully'
        ];

        $this->bookingService->shouldReceive('updateStatus')
            ->with($request, $booking)
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->updateStatus($request, $booking);
        $this->assertEquals($expectedResponse, $response);
    }

    public function test_destroy_deletes_booking()
    {
        $booking = new Booking(['id' => 1]);
        $expectedResponse = [
            'success' => true,
            'message' => 'Booking deleted successfully'
        ];

        $this->bookingService->shouldReceive('destroy')
            ->with($booking)
            ->once()
            ->andReturn($expectedResponse);

        $response = $this->controller->destroy($booking);
        $this->assertEquals($expectedResponse, $response);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
