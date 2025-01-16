<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'required|image|mimes:jpeg,png,gif|max:2048', // Hasta 2MB
            'user_id' => 'required|exists:users,id', // Verifica que el ID del usuario exista.
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser un texto válido.',
            'title.max' => 'El título no puede tener más de 255 caracteres.',
            'description.string' => 'La descripción debe ser un texto válido.',
            'image_path.require' => 'Seleccione una imagen',
            'image_path.image' => 'El archivo debe ser una imagen.',
            'image_path.mimes' => 'La imagen debe ser en formato JPEG, PNG o GIF.',
            'image_path.max' => 'La imagen no puede superar los 2MB.',
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error  = (new ValidationException($validator))->errors();
        throw new HttpResponseException( response()->json(['message' => 'Error de Validacion', 'data' => $error],400));
        parent::failedValidation($validator);

    }
}
