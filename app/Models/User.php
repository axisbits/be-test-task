<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    /**
     * @var string
     */
    private $plainTextToken;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string,string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => RoleEnum::class,
        ];
    }

    /**
     * Create a new access token for the user.
     *
     * @param string $name
     *
     * @return User
     *
     * @throws BindingResolutionException
     * @throws MassAssignmentException
     */
    public function createAccessToken(string $name): self
    {
        $token = $this->createToken($name);
        $this->withAccessToken($token->accessToken);
        $this->plainTextToken = $token->plainTextToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->plainTextToken;
    }

    /**
     * Check if the user has the given permission.
     *
     * @param string $permission
     *
     * @return bool
     */
    public function hasPermissionTo(string $permission): bool
    {
        $rolePermissions = RoleEnum::permissions($this->role);

        return \in_array($permission, $rolePermissions);
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return RoleEnum::admin()->is($this->role);
    }

    /**
     * @return HasMany<Company,$this>
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
