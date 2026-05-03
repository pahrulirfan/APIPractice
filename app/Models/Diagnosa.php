<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diagnosa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'diagnosa';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pasien_id',
        'penyakit_id',
        'catatan',
    ];

    /**
     * Get the pasien that owns the diagnosa.
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    /**
     * Get the penyakit that owns the diagnosa.
     */
    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class);
    }
}
