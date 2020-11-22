<?php

namespace App\Http\Controllers;

use App\Models\Coven;
use Illuminate\Http\Request;
use App\Models\Member;


class MembersController extends Controller
{
    public function store(Request $request)
    {
        return Member::query()->create($request->all());
    }

    public function show(): string
    {
        $membersData = Member::all();

        return collect([
            'data' => $membersData->toArray(),
            'count' => $membersData->count()
        ])->toJson();
    }

    public function addMemberToCoven(Request $request): void
    {
        $member = Member::query()->find($request->get('member_id'));
        $coven = Coven::query()->find($request->get('coven_id'));

        if ($member->exists() && $coven->exists()) {
            $coven->members()->save($member);
        }
    }

}
