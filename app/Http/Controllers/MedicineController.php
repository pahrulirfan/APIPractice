<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Http\Resources\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\JsonResponse;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $medicines = Medicine::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data medicine ditemukan',
            'data' => MedicineResource::collection($medicines),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicineRequest $request): JsonResponse
    {
        $medicine = Medicine::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Medicine berhasil dibuat',
            'data' => new MedicineResource($medicine),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $medicine = Medicine::find($id);

        if (!$medicine) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'errors' => [],
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data medicine ditemukan',
            'data' => new MedicineResource($medicine),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicineRequest $request, string $id): JsonResponse
    {
        $medicine = Medicine::find($id);

        if (!$medicine) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'errors' => [],
            ], 404);
        }

        $medicine->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Medicine berhasil diperbarui',
            'data' => new MedicineResource($medicine),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $medicine = Medicine::find($id);

        if (!$medicine) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'errors' => [],
            ], 404);
        }

        $medicine->delete();

        return response()->json([
            'success' => true,
            'message' => 'Medicine berhasil dihapus',
            'data' => [],
        ]);
    }
}
