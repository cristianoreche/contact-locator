<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
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
            'name'        => ['required', 'string'],
            'cpf'         => ['required', 'string', 'unique:contacts,cpf,' . $this->route('id')],
            'phone'       => ['required', 'string'],
            'cep'         => ['required', 'string'],
            'state'       => ['required', 'string'],
            'city'        => ['required', 'string'],
            'street'      => ['required', 'string'],
            'number'      => ['required', 'string'],
            'complement'  => ['nullable', 'string'],
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
}
