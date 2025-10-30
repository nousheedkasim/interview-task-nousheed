<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventSessionSpeakerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event_id' => 'required|exists:events,id',
            'event_session_id' => 'required|exists:event_sessions,id',
            'speaker_id' => [
                'required',
                'exists:speakers,id',
                // Ensure unique combination of event_session_id and speaker_id
                Rule::unique('event_session_speaker')
                ->where(function ($query) {
                    return $query->where('event_session_id', $this->event_session_id)
                    ->where('status', 1);;
                }),
                // custom validation: speaker must belong to the same event
                function ($attribute, $value, $fail) {
                    $speaker = \App\Models\Speaker::find($value);
                    if ($speaker && $speaker->event_id != $this->event_id) {
                        $fail('The selected speaker does not belong to the chosen event.');
                    }
                },
            ],
        ];
    }
}
