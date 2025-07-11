<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\Request;

class CompanyStoreRequest extends Request
{
    /**
     * @return array<string,array<mixed,mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:companies',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:companies',
            ],
            'phone' => [
                'required',
                'string',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'city' => [
                'required',
                'string',
                'max:255',
            ],
            'state' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
