<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;


class MembersController extends Controller
{
    public function store(Request $request)
    {
        return Member::create($request->all());
    }

    public function show(): string
    {
        $membersData = Member::all();

        return collect([
            'data' => $membersData->toArray(),
            'count' => $membersData->count()
        ])->toJson();
    }
}
