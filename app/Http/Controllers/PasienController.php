<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use App\Http\Resources\PasienResource;
use App\Models\Pasien;
use Illuminate\Http\JsonResponse;

class PasienController extends Controller
{
    /**
     * Display a listing of all pasien.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil diambil',
            'data'    => PasienResource::collection(Pasien::all()),
        ], 200);
    }

    /**
     * Display the specified pasien along with their penyakit relation.
     */
    public function show(int $id): JsonResponse
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->load('penyakit');

        return response()->json([
            'success' => true,
            'message' => 'Data pasien ditemukan',
            'data'    => new PasienResource($pasien),
        ], 200);
    }

    /**
     * Store a newly created pasien.
     */
    public function store(StorePasienRequest $request): JsonResponse
    {
        $pasien = Pasien::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil dibuat',
            'data'    => new PasienResource($pasien),
        ], 201);
    }

    /**
     * Update the specified pasien.
     */
    public function update(UpdatePasienRequest $request, int $id): JsonResponse
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil diperbarui',
            'data'    => new PasienResource($pasien),
        ], 200);
    }

    /**
     * Remove the specified pasien.
     * Cascade deletion of related diagnosa is handled by the FK constraint.
     */
    public function destroy(int $id): JsonResponse
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil dihapus',
            'data'    => (object) [],
        ], 200);
    }
}
