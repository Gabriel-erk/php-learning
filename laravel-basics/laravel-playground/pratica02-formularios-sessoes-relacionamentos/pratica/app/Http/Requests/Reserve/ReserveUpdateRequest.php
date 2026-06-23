<?php

namespace App\Http\Requests\Reserve;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReserveUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'integer'],
            'room_id' => ['sometimes', 'integer'],
            'reserve_date' => ['sometimes', 'date'],
            'start_time' => ['sometimes', 'date', 'before:end_time'],
            'end_time' => ['sometimes', 'date', 'after:start_time'],
            'observation' => ['sometimes', 'string']
        ];
    }
}
