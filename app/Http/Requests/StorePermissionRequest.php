<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Utils\Enums\Codes;
use App\Utils\Enums\Status;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Lang;

class StorePermissionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:50|unique:permissions,name',
            'slug' => 'required|min:3|max:50|unique:permissions,slug',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(ValidationValidator $validator)
    {
        $res = [
            'code' => Codes::UNPROCESSABLE,
            'status' => Status::ERROR,
            'message' => Lang::get('validation.not_validated'),
            'errors' => $validator->errors()
        ];

        throw new HttpResponseException(response()->json($res, $res['code']));
    }
}
