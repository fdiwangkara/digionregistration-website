<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category = $this->input('competition_id');

        // Determine member count limits based on competition
        $competition = \App\Models\Competition::find($category);
        $minMembers = $competition ? $competition->min_members : 2;
        $maxMembers = $competition ? $competition->max_members : 3;

        return [
            // Team info
            'competition_id' => ['required', 'exists:competitions,id'],
            'team_name' => ['required', 'string', 'max:100'],
            'school_name' => ['required', 'string', 'max:150'],
            'instagram' => ['nullable', 'string', 'max:50'],

            // Members
            'members' => ['required', 'array', "min:{$minMembers}", "max:{$maxMembers}"],
            'members.*.full_name' => ['required', 'string', 'max:100'],
            'members.*.birth_place' => ['required', 'string', 'max:100'],
            'members.*.birth_date' => ['required', 'date', 'before:today'],
            'members.*.nisn' => ['required', 'string', 'size:10'],
            'members.*.phone' => ['required', 'string', 'max:20'],
            'members.*.email' => ['required', 'email', 'max:100'],
            'members.*.is_leader' => ['sometimes', 'boolean'],

            // File uploads
            'student_card' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'twibbon' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'members.min' => 'Your team needs at least :min members for this competition.',
            'members.max' => 'Your team can have at most :max members for this competition.',
            'members.*.full_name.required' => 'Each member must have a full name.',
            'members.*.nisn.size' => 'NISN must be exactly 10 digits.',
            'members.*.email.email' => 'Please provide a valid email for each member.',
            'student_card.mimes' => 'Student card must be a PDF file.',
            'twibbon.mimes' => 'Twibbon proof must be a PDF file.',
            'payment_proof.mimes' => 'Payment proof must be a JPG or PNG image.',
        ];
    }
}
