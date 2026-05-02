<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pasien extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'pasien';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
    ];

    /**
     * Get the penyakit for the pasien (via diagnosa pivot table).
     */
    public function penyakit(): BelongsToMany
    {
        return $this->belongsToMany(Penyakit::class, 'diagnosa')
                    ->withPivot('catatan')
                    ->withTimestamps();
    }
}
