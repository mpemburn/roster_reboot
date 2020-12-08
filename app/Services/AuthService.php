<?php


namespace App\Services;


use App\Models\User;
use Carbon\Carbon;
use DomainException;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UnexpectedValueException;

class AuthService
{
    public function getAuthTokenByKey(Request $request): string
    {
        $authKey = $request->get('key');

        if ($authKey && $authKey === env('AUTH_USER_KEY')) {
            $payload = array(
                'auth_key' => $authKey,
                "now" => Carbon::now()->getTimestamp(),
            );
            // NOTE: Requires private key in .env joined by \\n
            $privateKey = str_replace("\\n", PHP_EOL, env('AUTH_PRIVATE_KEY'));
            $jwt = JWT::encode($payload, $privateKey, 'RS256');

            return response()->json([
                'auth_token' => $jwt
            ], 200);
        }

        return response()->json([
            'error' => 'Unauthorized access'
        ], 401);
    }

    public function getAuthTokenForUser(Request $request): string
    {
        $credentials = $request->all();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user) {
                $payload = array(
                    'user_id' => $user->id,
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

    public function validateAuthToken($authToken): bool
    {
        $publicKey = str_replace("\\n", PHP_EOL, env('AUTH_PUBLIC_KEY'));
        try {
            $decoded = JWT::decode($authToken, $publicKey, ['RS256']);
            // Handle JWT containing auth_key
            if ($decoded && $decoded->auth_key) {
                return $decoded->auth_key === env('AUTH_USER_KEY');
            }
            // Handle JWT containing user_id
            if ($decoded && $decoded->user_id) {
                $user = User::query()->find($decoded->user_id);
                if ($user->exists()) {
                    return true;
                }
            }
        } catch (DomainException $exception) {
            // TODO: Add logging
        } catch (UnexpectedValueException $exception) {
            // TODO: Add logging
        }

        return false;
    }
}
