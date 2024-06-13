<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->route('user') ? $this->route('user')->id : null;

        if ($this->isMethod('post')) {
            // Validation rules for creating a user
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
                'dob' => 'required|date',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // Validation rules for updating a user
            return [
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $userId,
                'password' => 'nullable|string|min:8',
                'dob' => 'sometimes|required|date',
            ];
        }

        return [];
    }
}
