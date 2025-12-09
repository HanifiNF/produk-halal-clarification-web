<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'admin',
        'data_access',
        'nama_umkm',
        'address',
        'city',
        'province',
        'establish_year',
        'pembina',
        'status_pembina',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'establish_year' => 'integer',
    ];

    /**
     * Get the products for the user/UMKM.
     */
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'umkm_id', 'id');
    }

    /**
     * Get the users that this user is a pembina for (using name as foreign key).
     */
    public function binaan()
    {
        return $this->hasMany(\App\Models\User::class, 'pembina', 'name');
    }

    /**
     * Get the pembina for this user (using name as foreign key).
     */
    public function pembinaUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'pembina', 'name');
    }
}
