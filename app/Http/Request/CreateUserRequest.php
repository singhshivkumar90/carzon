<?php
declare(strict_types=1);

namespace App\Http\Request;

class CreateUserRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|unique:users|email|is_valid_domain',
            'password' => 'required|min:6|max:10',
            'role' => 'required|integer|exists:roles,id'
        ];
    }
}
