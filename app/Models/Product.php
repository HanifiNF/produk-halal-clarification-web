<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'product_image',
        'date',
        'verification_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'verification_status' => 'boolean',
    ];

    /**
     * Get the user/UMKM that owns the product.
     */
    public function umkm()
    {
        return $this->belongsTo(\App\Models\User::class, 'umkm_id', 'id');
    }
}