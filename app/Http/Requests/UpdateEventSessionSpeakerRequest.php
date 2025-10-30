<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventSessionSpeakerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        
        $id = $this->route('event_session_speaker');
        if ($id instanceof \App\Models\EventSessionSpeaker) {
            $id = $id->id;
        }

        return [
            'event_id' => 'required|exists:events,id',
            'event_session_id' => 'required|exists:event_sessions,id',
            'speaker_id' => [
                'required',
                'exists:speakers,id',
                Rule::unique('event_session_speaker')
                    ->where(function ($query) {
                        return $query->where('event_session_id', $this->event_session_id);
                    })
                    ->ignore($id, 'id'), // allow same mapping for current record
                function ($attribute, $value, $fail) {
                    $speaker = \App\Models\Speaker::find($value);
                    if ($speaker && $speaker->event_id != $this->event_id) {
                        $fail('The selected speaker does not belong to the chosen event.');
                    }
                },
            ],
            'status' => 'required|in:0,1',
        ];

    }
}
