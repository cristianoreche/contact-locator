<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\CpfValidator;

class ContactUpdateRequest extends FormRequest
{
    use CpfValidator;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'cpf' => ['required', 'string', 'unique:contacts,cpf,' . $this->route('id')],
            'phone' => ['required', 'string'],
            'cep' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'bairro' => ['nullable', 'string'],
            'street' => ['required', 'string'],
            'number' => ['required', 'string'],
            'complement' => ['nullable', 'string'],
            'latitude' => ['nullable', 'string'],
            'longitude' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'phone.required' => 'O telefone é obrigatório.',
            'cep.required' => 'O CEP é obrigatório.',
            'state.required' => 'O estado é obrigatório.',
            'city.required' => 'A cidade é obrigatória.',
            'street.required' => 'A rua é obrigatória.',
            'number.required' => 'O número é obrigatório.',
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->isValidCpf($this->cpf)) {
                $validator->errors()->add('cpf', 'CPF inválido.');
            }
        });
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(response()->json([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => $validator->errors(),
            ], 422));
        }

        parent::failedValidation($validator);
    }

}
