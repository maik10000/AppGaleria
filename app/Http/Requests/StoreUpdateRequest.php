<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class StoreUpdateRequest extends FormRequest
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
            'uuid_name'=> 'required|uuid|exists:photos,uuid_name',
            'description' => 'nullable|string',
            'image_path' => 'required|image|mimes:jpeg,png,gif|max:2048',
            'id_user' => 'required|exists:users,id', 
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'uuid_name.required' => 'se requiere uuid de la imagen',
            'uuid_name.uuid' => 'el UUID no es valido',
            'uuid_name.exists' => 'el UUID no es valido',
            'title.string' => 'El título debe ser un texto válido.',
            'title.max' => 'El título no puede tener más de 255 caracteres.',
            'description.string' => 'La descripción debe ser un texto válido.',
            'image_path.require' => 'Seleccione una imagen',
            'image_path.image' => 'El archivo debe ser una imagen.',
            'image_path.mimes' => 'La imagen debe ser en formato JPEG, PNG o GIF.',
            'image_path.max' => 'La imagen no puede superar los 2MB.',
            'id_user.required' => 'El usuario es obligatorio.',
            'id_user.exists' => 'El usuario seleccionado no existe.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error  = (new ValidationException($validator))->errors();
        throw new HttpResponseException( response()->json(['message' => 'Error de Validacion', 'data' => $error],400));
        parent::failedValidation($validator);

    }
}
