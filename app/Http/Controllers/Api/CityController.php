<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query();

        if ($request->filled('state_id')) {

            $query->where(
                'state_id',
                $request->integer('state_id')
            );
        }

        return $query
            ->orderBy('name')
            ->get();
    }
}
