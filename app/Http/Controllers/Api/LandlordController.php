<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use App\Http\Requests\StoreLandlordRequest;
use App\Http\Requests\UpdateLandlordRequest;

class LandlordController extends Controller
{
    public function index()
    {
        return response()->json(
            Landlord::with('user:id,name,email,phone')->paginate(10)
        );
    }

    public function store(StoreLandlordRequest $request)
    {
        $landlord = Landlord::create($request->validated());

        return response()->json($landlord->load('user'), 201);
    }

    public function show(Landlord $landlord)
    {
        return response()->json($landlord->load('user', 'buildings'));
    }

    public function update(UpdateLandlordRequest $request, Landlord $landlord)
    {
        $landlord->update($request->validated());

        return response()->json($landlord->load('user'));
    }

    public function destroy(Landlord $landlord)
    {
        $landlord->delete();

        return response()->json(['message' => 'Landlord deleted successfully']);
    }
}
