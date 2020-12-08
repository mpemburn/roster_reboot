<?php


namespace App\Services;


use App\Models\User;
use DomainException;
use Firebase\JWT\JWT;
use UnexpectedValueException;

class AuthService
{
    public function validateAuthToken($authToken): bool
    {
        $publicKey = str_replace("\\n", PHP_EOL, env('AUTH_PUBLIC_KEY'));
        try {
            $decoded = JWT::decode($authToken, $publicKey, ['RS256']);
            if ($decoded) {
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
