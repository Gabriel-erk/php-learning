<?php

namespace App\Http\Requests\Reserve;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReserveStoreRequest extends FormRequest
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
            'user_id' => ['required', 'integer'],
            'room_id' => ['required', 'integer'],
            'reserve_date' => ['required', 'date', 'after_or_equal:today'], // after_or_equal:today == depois ou igual (after_or_equal) de hoje (today), ou seja, o campo reserve_date só permite receber valores (em formato de data, obviamente) em datas DEPOIS ou IGUAIS as de hoje
            'start_time' => ['required', 'date', 'before:end_time'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'observation' => ['required', 'string']
        ];
    }
}
