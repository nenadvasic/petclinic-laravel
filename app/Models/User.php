<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Tymon\JWTAuth\Contracts\JWTSubject as JwtAuthenticatableContract;

class User extends AbstractModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    JwtAuthenticatableContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();  // Eloquent model method
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        // TODO
        return [
            'user' => [
                'id' => $this->id,
            ],
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function vet()
    {
        return $this->hasOne('\App\Models\Vet');
    }

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return ($this->role === strtoupper($role));
    }

    /**
     * @param array $roles
     * @return bool
     */
    public function roleIn(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->role === strtoupper($role)) {
                return true;
            }
        }

        return false;
    }
}
