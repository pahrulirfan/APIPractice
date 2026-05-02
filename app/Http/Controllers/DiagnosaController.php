<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiagnosaRequest;
use App\Http\Resources\PasienResource;
use App\Models\Pasien;
use Illuminate\Http\JsonResponse;

class DiagnosaController extends Controller
{
    /**
     * Add diagnosa (penyakit) to a pasien without creating duplicates.
     * Uses syncWithoutDetaching to ensure idempotent operation.
     */
    public function store(StoreDiagnosaRequest $request, int $pasienId): JsonResponse
    {
        $pasien = Pasien::findOrFail($pasienId);

        $pasien->penyakit()->syncWithoutDetaching($request->validated()['penyakit_id']);

        $pasien->load('penyakit');

        return response()->json([
            'success' => true,
            'message' => 'Diagnosa berhasil ditambahkan',
            'data'    => new PasienResource($pasien),
        ], 200);
    }

    /**
     * Remove a specific diagnosa (penyakit) from a pasien.
     * Returns 404 if the relation does not exist.
     */
    public function destroy(int $pasienId, int $penyakitId): JsonResponse
    {
        $pasien = Pasien::findOrFail($pasienId);

        if (! $pasien->penyakit()->where('penyakit_id', $penyakitId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Diagnosa tidak ditemukan',
                'errors'  => (object) [],
            ], 404);
        }

        $pasien->penyakit()->detach($penyakitId);

        return response()->json([
            'success' => true,
            'message' => 'Diagnosa berhasil dihapus',
            'data'    => (object) [],
        ], 200);
    }
}
