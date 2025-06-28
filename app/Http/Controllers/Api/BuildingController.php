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
            'landlord:id,business_name',
            'units:id,building_id,unit_number'
        ])->select('id', 'name', 'address', 'landlord_id');

        return response()->json($query->paginate(10));
    }

    public function store(StoreBuildingRequest $request)
    {
        $building = Building::create($request->validated());

        return response()->json($building->load('landlord'), 201);
    }

    public function show(Building $building)
    {
        return response()->json($building->load(['landlord', 'units']));
    }

    public function update(UpdateBuildingRequest $request, Building $building)
    {
        $this->authorize('update', $building);

        $building->update($request->validated());

        return response()->json($building->load('landlord'));
    }

    public function destroy(Building $building)
    {
        $this->authorize('delete', $building);

        $building->delete();

        return response()->json(['message' => 'Building deleted successfully.']);
    }
}
