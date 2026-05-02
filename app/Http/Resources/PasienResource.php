<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PasienResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'nama'           => $this->nama,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'alamat'         => $this->alamat,
            'no_telepon'     => $this->no_telepon,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
            'penyakit'       => PenyakitResource::collection($this->whenLoaded('penyakit')),
        ];
    }
}
