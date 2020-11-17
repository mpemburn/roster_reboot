<?php

namespace App\Http\Controllers;

use App\Models\Coven;
use Illuminate\Http\Request;

class CovenController extends Controller
{
    public function show()
    {
        $covensData = Coven::all();

        return collect([
            'data' => $covensData->toArray(),
            'count' => $covensData->count()
        ])->toJson();
    }
}
