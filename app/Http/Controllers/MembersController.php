<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use JsonException;


class MembersController extends Controller
{
    public function store(Request $request)
    {
        return Member::create($request->all());
    }

    public function show(): string
    {
        $membersData = Member::all()->toArray();

        try {
            return json_encode(['data' => $membersData], JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return '{
              "error": {
                "message": ' . $e->getMessage() . ',
                "code": 400,
              }
            }';
        }

    }
}
