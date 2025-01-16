<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UserDeleteRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'id_user' => 'required|exists:users,id',
        ];
    }
    public function messages()
    {
        return [
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
