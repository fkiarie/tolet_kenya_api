<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;

class TenantController extends Controller
{
    public function index()
    {
        return response()->json(Tenant::with(['user', 'unit.building'])->paginate(10));
    }

    public function store(StoreTenantRequest $request)
    {
        $tenant = Tenant::create($request->validated());

        if ($tenant->unit) {
            $tenant->unit->update(['is_occupied' => true]);
        }

        return response()->json($tenant->load(['user', 'unit.building']), 201);
    }

    public function show(Tenant $tenant)
    {
        return response()->json($tenant->load(['user', 'unit.building']));
    }

    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        $tenant->update($request->validated());
        return response()->json($tenant->load(['user', 'unit.building']));
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        if ($tenant->unit) {
            $tenant->unit->update(['is_occupied' => false]);
        }

        return response()->json(['message' => 'Tenant removed and unit marked unoccupied']);
    }
}
