<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'status' => 'required|boolean',
        ];
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] .= '|unique:services,name,' . $this->service->id;
        } else {
            $rules['name'] .= '|unique:services,name';
        }
        return $rules;
    }

    public function message()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'A service with this name already exists',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'status.required' => 'The status field is required.',
            'price.min' => 'Service price cannot be less than 1',
        ];
    }
}
