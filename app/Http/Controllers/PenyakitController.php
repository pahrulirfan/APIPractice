<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenyakitRequest;
use App\Http\Requests\UpdatePenyakitRequest;
use App\Http\Resources\PenyakitResource;
use App\Models\Penyakit;
use Illuminate\Http\JsonResponse;

class PenyakitController extends Controller
{
    /**
     * Display a listing of all penyakit.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data penyakit berhasil diambil',
            'data'    => PenyakitResource::collection(Penyakit::all()),
        ], 200);
    }

    /**
     * Display the specified penyakit along with their pasien relation.
     */
    public function show(int $id): JsonResponse
    {
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->load('pasien');

        return response()->json([
            'success' => true,
            'message' => 'Data penyakit ditemukan',
            'data'    => new PenyakitResource($penyakit),
        ], 200);
    }

    /**
     * Store a newly created penyakit.
     */
    public function store(StorePenyakitRequest $request): JsonResponse
    {
        $penyakit = Penyakit::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Penyakit berhasil dibuat',
            'data'    => new PenyakitResource($penyakit),
        ], 201);
    }

    /**
     * Update the specified penyakit.
     */
    public function update(UpdatePenyakitRequest $request, int $id): JsonResponse
    {
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Penyakit berhasil diperbarui',
            'data'    => new PenyakitResource($penyakit),
        ], 200);
    }

    /**
     * Remove the specified penyakit.
     * Cascade deletion of related diagnosa is handled by the FK constraint.
     */
    public function destroy(int $id): JsonResponse
    {
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penyakit berhasil dihapus',
            'data'    => (object) [],
        ], 200);
    }
}
