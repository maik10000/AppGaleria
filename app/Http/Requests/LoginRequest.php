<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->isMethod('POST');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
           
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo es incorrecto',
            'password.required' => 'Ingrese la contraseña',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error  = (new ValidationException($validator))->errors();
        throw new HttpResponseException( response()->json(['message' => 'Error de Validacion', 'data' => $error],400));
        parent::failedValidation($validator);

    }
}
