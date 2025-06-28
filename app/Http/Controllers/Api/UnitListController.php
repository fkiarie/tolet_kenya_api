<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitListController extends Controller
{
    public function index(Request $request)
    {
        $query = Unit::with('building');

        // Optional: filter by availability
        if ($request->has('available')) {
            $query->where('is_occupied', false);
        }

        return response()->json($query->paginate(20));
    }
}
