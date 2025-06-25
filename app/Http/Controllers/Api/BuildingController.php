<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;

class BuildingController extends Controller

{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Building::with([
            'landlord.user:id,name,email', // adjust columns as needed
            'units:id,building_id,unit_number' // adjust columns as needed
        ])->select('id', 'name', 'address', 'landlord_id'); // adjust columns as needed

        if ($request->user()->role === 'landlord') {
            $query->whereHas('landlord', fn($q) => $q->where('user_id', $request->user()->id));
        }

        return response()->json($query->paginate(10));
    }

    public function store(StoreBuildingRequest $request)
    {

        $landlord = $request->user()->landlordProfile;

        if (!$landlord) {
            return response()->json(['error' => 'Landlord profile required'], 400);
        }

        $building = Building::create([
            ...$request->validated(),
            'landlord_id' => $request->user()->landlordProfile->id,
        ]);

        return response()->json($building, 201);
    }

    public function show(Building $building)
    {
            return response()->json($building->load(['landlord.user', 'units']));
    }

    public function update(UpdateBuildingRequest $request, Building $building)
    {
        $this->authorize('update', $building);

        $validated = $request->validated();

        $building->update($validated);

        return response()->json($building->load('landlord.user'));
    }

    public function destroy(Building $building)
    {
        $this->authorize('delete', $building);
        $building->delete();

        return response()->json(['message' => 'Building deleted successfully.']);
}
}