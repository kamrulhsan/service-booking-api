<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() && !auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'The service field is required.',
            'booking_date.required' => 'The booking date field is required.',
            'status.required' => 'The status field is required.',
        ];
    }
}
