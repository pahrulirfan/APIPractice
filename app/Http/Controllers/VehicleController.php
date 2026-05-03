<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $vehicles = Vehicle::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data vehicle ditemukan',
            'data' => VehicleResource::collection($vehicles),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request): JsonResponse
    {
        $vehicle = Vehicle::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Vehicle berhasil dibuat',
            'data' => new VehicleResource($vehicle),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'errors' => [],
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data vehicle ditemukan',
            'data' => new VehicleResource($vehicle),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, string $id): JsonResponse
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'errors' => [],
            ], 404);
        }

        $vehicle->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Vehicle berhasil diperbarui',
            'data' => new VehicleResource($vehicle),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'errors' => [],
            ], 404);
        }

        $vehicle->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vehicle berhasil dihapus',
            'data' => [],
        ]);
    }
}
