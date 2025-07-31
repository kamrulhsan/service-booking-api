<?php

namespace App\Services\v1;

use App\Models\Booking;
use App\Models\Service;

class BookingService
{

    public function all()
    {
        $user = auth()->user();

        if ($user->IsAdmin()) {
            $bookings = Booking::with('user:id,name', 'service:id,name,price,status')
                ->orderBy('booking_date', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $bookings
            ]);
        }
    }

    public function create($data)
    {
        try {
            $booking = Booking::create([
            'user_id' => auth()->user()->id,
            'service_id' => $data['service_id'],
            'booking_date' => $data['booking_date'],
            'status' => $data['status'] ?? 'pending',
        ]);

        return response()->json([
                'success' => true,
                'message' => 'Service created successfully',
                'data' => $booking
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
        
    }

    public function updateStatus($request, $booking)
    {
        $booking->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Booking status updated successfully',
            'data' => $booking
        ]);
    }

    public function fetchByUser()
    {
        $user = auth()->user();

        $bookings =  Booking::with('user:id,name', 'service:id,name,price,status')->where('user_id', $user->id)
                        ->orderBy('booking_date', 'desc')->get();
        $bookingData = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'user' => $booking->user?->name,
                'service' => $booking->service?->name,
                'servicePrice' => $booking->service?->price,
                'bookingDate' => $booking->booking_date?->format('Y-m-d'),
                'status' => $booking->status,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $bookingData
        ]);
    }

    public function destroy($booking)
    {
        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully'
        ]);
    }
}