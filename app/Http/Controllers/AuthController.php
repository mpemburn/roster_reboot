<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use App\Rules\EmailExists;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use JsonException;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function signup(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'string', 'email', 'unique:users', new EmailExists()],
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        $member = Email::query()
            ->where('email', $request->email)
            ->first()
            ->member()
            ->first();

        !d($member->id);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();

//        $member->user()->save($user);
        $user->member()->save($member);

        return response()->json([
            'success' => true,
            'message' => 'Successfully created user!',
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'success' => true,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function getAuthToken(Request $request)
    {
        $credentials = $request->all();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user) {
                $payload = array(
                    'name' => $user->name,
                    "email" => $credentials['email'],
                    "now" => Carbon::now()->getTimestamp(),
                );
                // NOTE: Requires private key in .env joined by \\n
                $privateKey = str_replace("\\n", PHP_EOL, env('AUTH_PRIVATE_KEY'));
                $jwt = JWT::encode($payload, $privateKey, 'RS256');

                return response()->json([
                    'auth_token' => $jwt
                ], 200);
            }
        }

        return response()->json([
            'error' => 'Unauthorized access'
        ], 401);
    }
}

