<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Penyakit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'penyakit';

    protected $fillable = [
        'kode_icd',
        'nama',
        'deskripsi',
        'kategori',
    ];

    /**
     * Get the pasien for the penyakit (via diagnosa pivot table).
     */
    public function pasien(): BelongsToMany
    {
        return $this->belongsToMany(Pasien::class, 'diagnosa')
                    ->withPivot('catatan')
                    ->withTimestamps();
    }
}
