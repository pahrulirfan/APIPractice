<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenyakitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'kode_icd'   => $this->kode_icd,
            'nama'       => $this->nama,
            'deskripsi'  => $this->deskripsi,
            'kategori'   => $this->kategori,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'pasien'     => PasienResource::collection($this->whenLoaded('pasien')),
        ];
    }
}
