<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'email' => strtolower($this->email),
            'document' => preg_replace('/\D/', '', $this->document),
            'phone' => preg_replace('/\D/', '', $this->phone),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       return [
            'name' => ['sometimes', 'string', 'max:255'],
            'document' => ['sometimes', 'string', 'max:20'],
            'phone' => ['sometimes', 'string', 'max:20'],
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('users')->ignore($this->route('user')->id)],
            'role'  => ['sometimes', 'string', 'max:50'],
            'status'  => ['sometimes', 'string', 'max:50'],
        ];
    }
}
