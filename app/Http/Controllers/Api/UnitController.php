<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;

class UnitController extends Controller
{
    public function index(Building $building)
    {
        return response()->json($building->units()->with('tenant')->paginate(10));
    }

    public function store(StoreUnitRequest $request, Building $building)
    {
        $unit = $building->units()->create($request->validated());
        return response()->json($unit->load('building'), 201);
    }

    public function show(Building $building, Unit $unit)
    {
        if ($unit->building_id !== $building->id) {
            abort(404, 'Unit does not belong to this building');
        }

        return response()->json($unit->load('tenant'));
    }

    public function update(UpdateUnitRequest $request, Building $building, Unit $unit)
    {
        if ($unit->building_id !== $building->id) {
            abort(404, 'Unit mismatch');
        }

        $unit->update($request->validated());

        return response()->json($unit->load('tenant'));
    }

    public function destroy(Building $building, Unit $unit)
    {
        if ($unit->building_id !== $building->id) {
            abort(404, 'Unit mismatch');
        }

        $unit->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
