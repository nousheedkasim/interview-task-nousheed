<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // allow all for now
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * 
     * 
     */
    public function rules(): array
    {
        return [
            
            'title' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'nullable|after:start_time',           
            'description' => 'nullable|string',
            'event_id' => 'required|exists:events,id',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'event_id.required' => 'The event ID is required.',
            'event_id.exists' => 'The selected event does not exist.',
            'title.required' => 'The session title is required.',
            'start_time.required' => 'Please specify a start time.',
            'end_time.after' => 'End time must be after start time.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
