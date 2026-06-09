<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State;

class StateController extends Controller
{
    public function index()
    {
        return State::query()
            ->orderBy('name')
            ->get();
    }
}