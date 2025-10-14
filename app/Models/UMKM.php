<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'umkm';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'owner',
        'nama_umkm',
        'email_umkm',
        'nomor_handphone_umkm',
        'alamat',
        'kota',
        'provinsi',
        'tahun_berdiri',
    ];

    /**
     * Get the user that owns the UMKM.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
