<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow all authenticated users for now — adjust as needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'event_id'    => 'required|exists:events,id',
            'title'       => 'required|string|max:255',
            'start_time'  => 'required',
            'end_time'    => 'nullable|after:start_time',
            'description' => 'nullable|string',
            'status'      => 'required',
        ];
    }

    /**
     * Customize validation messages.
     */
    public function messages(): array
    {
        return [
            'event_id.required'   => 'Please select an event.',
            'event_id.exists'     => 'Selected event does not exist.',
            'title.required'      => 'Session title is required.',
            'start_time.required' => 'Start time is required.',
            'end_time.after'      => 'End time must be after the start time.',
            'status.required'     => 'Please select a status.',
        ];
    }
}
