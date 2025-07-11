<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'created_by',
    ];

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (Company $company) {
            $auth = \auth('sanctum');

            if ($auth->check()) {
                /** @var User $user */
                $user = $auth->user();

                $company->user_id = $user->id;
                $company->created_by = $user->id;
            }
        });
    }

    /**
     * @return BelongsTo<User,$this>
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo<User,$this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
