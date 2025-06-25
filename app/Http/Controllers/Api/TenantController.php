<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    /**
     * Display a paginated listing of tenants with related user and unit/building data.
     */
    public function index()
    {
        return response()->json(Tenant::with(['user', 'unit.building'])->paginate(10));
    }

    /**
     * Store a newly created tenant in storage.
     * Handles photo upload and marks the unit as occupied.
     */
    public function store(StoreTenantRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('tenants', 'public');
        }

        $tenant = Tenant::create($data);

        if ($tenant->unit) {
            $tenant->unit->update(['is_occupied' => true]);
        }

        return response()->json($tenant->load(['user', 'unit.building']), 201);
    }

    /**
     * Display the specified tenant with related user and unit/building data.
     */
    public function show(Tenant $tenant)
    {
        return response()->json($tenant->load(['user', 'unit.building']));
    }

    /**
     * Update the specified tenant in storage.
     * Handles photo replacement and deletes the old photo if present.
     */
    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($tenant->photo && Storage::disk('public')->exists($tenant->photo)) {
                Storage::disk('public')->delete($tenant->photo);
            }

            // Store new photo
            $data['photo'] = $request->file('photo')->store('tenants', 'public');
        }

        $tenant->update($data);

        return response()->json($tenant->load(['user', 'unit.building']));
    }

    /**
     * Remove the specified tenant from storage.
     * Marks the associated unit as unoccupied.
     */
    public function destroy(Tenant $tenant)
{
    if ($tenant->photo && Storage::disk('public')->exists($tenant->photo)) {
        Storage::disk('public')->delete($tenant->photo);
    }

    $tenant->delete();

    if ($tenant->unit) {
        $tenant->unit->update(['is_occupied' => false]);
    }

    return response()->json(['message' => 'Tenant and photo deleted successfully.']);
}

}

