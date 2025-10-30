<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpeakerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event_id' => 'sometimes|exists:events,id',
            'name' => 'sometimes|string|max:255',
            'expertise' => 'nullable|string|max:255',
        ];
    }
}
