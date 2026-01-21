<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'birth_date',
        'cpf',
        'address',
        'status'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getPhoneFormattedAttribute()
    {
        if (!$this->phone) {
            return null;
        }

        $phone = preg_replace('/\D/', '', $this->phone);

        if (strlen($phone) === 11) {
            // Celular
            return preg_replace(
                "/(\d{2})(\d{5})(\d{4})/",
                "($1) $2-$3",
                $phone
            );
        }

        // Fixo
        return preg_replace(
            "/(\d{2})(\d{4})(\d{4})/",
            "($1) $2-$3",
            $phone
        );
    }

    protected $dates = [
        'deleted_at',
    ];

    protected $casts = [
        'last_login' => 'datetime',
    ];

}
