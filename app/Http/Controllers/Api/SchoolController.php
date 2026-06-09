<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $query = School::query();

        if ($request->filled('city_id')) {

            $query->where('city_id', $request->city_id);
        }

        return $query
            ->orderBy('name')
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city_id' => [
                'required',
                'exists:cities,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $existing = School::query()
            ->where('city_id', $validated['city_id'])
            ->whereRaw(
                'LOWER(name) = ?',
                [mb_strtolower($validated['name'])]
            )
            ->first();

        if ($existing) {

            return response()->json([
                'message' => 'Escola já cadastrada',
                'school' => $existing,
            ], 409);
        }

        $school = School::create([
            'city_id' => $validated['city_id'],
            'name' => $validated['name'],
        ]);

        return response()->json(
            $school,
            201
        );
    }
}
