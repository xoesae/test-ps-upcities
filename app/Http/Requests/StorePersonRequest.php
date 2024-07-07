<?php

namespace App\Http\Requests;

use App\Rules\CPF;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $document_number
 * @property string $phone_number
 */
class StorePersonRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'document_number' => ['required', 'string', 'size:11', 'unique:people,document_number', new CPF()],
            'birth' => ['required', 'date_format:Y-m-d'],
            'email' => ['required', 'email', 'unique:people,email'],
            'phone_number' => ['required', 'string'],
            'address.street' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string', 'size:2'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute precisa ser um texto.',
            'max' => 'O campo :attribute precisa ter no máximo :max caracteres.',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres.',
            'unique' => 'Já existe uma pessoa cadastrada com este :attribute.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'document_number' => 'CPF',
            'birth' => 'nascimento',
            'email' => 'e-mail',
            'phone_number' => 'número de telefone',
            'address' => ['nullable', 'array'],
            'address.street' => 'logradouro',
            'address.city' => 'cidade',
            'address.state' => 'estado',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'document_number' => preg_replace('~\D~', '', $this->document_number),
            'phone_number' => preg_replace('~\D~', '', $this->phone_number),
        ]);
    }
}
