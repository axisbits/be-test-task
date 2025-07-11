<?php

namespace App\Transformers;

use App\Models\User;

class AuthLoginTransformer extends Transformer
{
    /**
     * Transform entity.
     *
     * @param User $user
     *
     * @return array<mixed,mixed>
     */
    public function transform($user): array
    {
        return [
            'access' => [
                'token' => $user->getAccessToken(),
                'token_type' => 'Bearer',
            ],
            'user' => $user->only([
                'id',
                'first_name',
                'last_name',
                'email',
                'role',
            ]),
        ];
    }
}
