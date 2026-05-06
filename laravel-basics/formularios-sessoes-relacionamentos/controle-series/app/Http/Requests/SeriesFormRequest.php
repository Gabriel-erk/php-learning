<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

// esta classe já extende de 'FormRequest', então em nossa classe personalizada (SeriesFormRequest) podemos fazer TUDO que uma requisićão normal já faz
class SeriesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // retornando um true pois como AINDA não estamos trabalhando com autenticaćão, todos estarão autorizado/autenticados para realizar requests deste tipo (SeriesFormRequest) 
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // aqui entra o que realmente precisamos, as regras de validaćão
        return [
            //
        ];
    }
}
