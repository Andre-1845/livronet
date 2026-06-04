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

        if ($request->city_id) {

            $query->where('city_id', $request->city_id);
        }

        return $query
            ->orderBy('name')
            ->get();
    }
}
