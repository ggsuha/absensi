<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;

class ContactRequest extends BaseRequest
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
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255',
            'content'   => 'required|max:500',
            'recaptcha' => [
                'required',
                function ($attribute, $value, $fail) {
                    $recaptchaResponse = (new ReCaptcha(env('RECAPTCHA_SECRET')))
                                            ->verify($value, Request::ip());

                    if ($recaptchaResponse->isSuccess()) {
                        $fail('The '.$attribute.' is invalid.');
                    }
                },
            ]
        ];
    }
}
