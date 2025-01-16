<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'age' => 'required|date|before:today',
            'id_user' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo es incorrecto',
            'email.unique' => 'Este correo ya está registrado.',
            'phone.digits' => 'El número de teléfono debe tener 10 dígitos.',
            'age.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'id_user.required' => 'El usuario es obligatorio.',
            'id_user.exists' => 'El usuario no existe.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error  = (new ValidationException($validator))->errors();
        throw new HttpResponseException( response()->json(['message' => 'Error de Validacion', 'data' => $error],400));
        parent::failedValidation($validator);

    }
}
