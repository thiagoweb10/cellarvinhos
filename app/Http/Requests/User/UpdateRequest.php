<?php

namespace App\Http\Requests\User;

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
            'name' => ['required', 'string', 'max:255'],
            'document' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
            'photo' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'role'  => ['required', 'string', 'max:50'],
        ];
    }
}
