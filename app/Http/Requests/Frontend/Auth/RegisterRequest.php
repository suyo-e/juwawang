<?php

namespace App\Http\Requests\Frontend\Auth;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends Request
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
            'name'                 => 'required|max:255',
            //'email'                => ['required', 'email', 'max:255', Rule::unique('users')],
            'phone'                => 'required|min:6',
            'password'             => 'required|min:6',
            'verify_code'          => 'required|numeric',
            'type'                 => 'required|numeric',
            'manufa_1'             => 'required',
            //'manufa_2'             => 'required',
            'province_city'        => 'required',
            //'industry_name'        => 'required',
            'g-recaptcha-response' => 'required_if:captcha_status,true|captcha',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => trans('validation.required', ['attribute' => 'captcha']),
        ];
    }
}
