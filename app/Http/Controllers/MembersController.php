<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberResource;
use App\Models\Coven;
use App\Models\Email;
use App\Models\User;
use App\Services\AuthService;
use DomainException;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\DB;


class MembersController extends Controller
{
    public function store(Request $request)
    {
        if ((new AuthService())->validateAuthToken($request->get('auth_token'))) {
            $data = collect($request->all())->except('auth_token');

            return Member::query()->create($data->toArray());
        }

        return response()->json([
            'error' => 'Unauthorized'
        ], 403);
    }

    public function show(Request $request): JsonResponse
    {
        $authToken = $request->get('auth_token');

        if ((new AuthService())->validateAuthToken($authToken)) {
            $membersData = Member::all();

            return response()->json([
                'data' => $membersData->toArray(),
                'count' => $membersData->count()
            ], 200);
        }

        return response()->json([
            'error' => 'Unauthorized access'
        ], 401);
    }

    public function updateMember(Request $request, $id): void
    {
        $member = Member::query()->find($id);

        $member->update($request->all());
    }

    public function addEmailToMember(Request $request): void
    {
        $member = Member::query()->find($request->get('member_id'));
        $email = new Email([
            'member_id' => $member->id,
            'email' => $request->get('email'),
            'description' => $request->get('description'),
            'is_primary' => $request->get('is_primary')
        ]);

        $member->emails()->save($email);
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
