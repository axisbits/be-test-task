<?php

namespace App\Http\Requests\User;

use App\Enums\RoleEnum;
use App\Http\Requests\Request;
use BenSampo\Enum\Rules\EnumValue;

class UserStoreRequest extends Request
{
    /**
     * @return array<string,array<mixed,mixed>>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => [
                'required',
                'string',
                'min:4',
            ],
            'role' => [
                'required',
                new EnumValue(RoleEnum::class),
            ],
        ];
    }
}
