<?php

namespace App\Http\Services\Auth;

use App\Enums\MessageEnum;
use App\Http\Resources\User\UserResource;
use App\Models\AdminRole;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($username, $password)
    {
        $message = MessageEnum::SUCCESS_LOGIN;

        $credentials = ['username' => $username, 'password' => $password];
        if (Auth::attempt($credentials)) {
            $user = User::with('company', 'role', 'division')->find(Auth::id());

            $user->tokens()->delete();

            if ($user->isAdmin) {
                $abilities = ($this)->getRoleAbilities($user->isAdmin->admin_role_id);
            } else {
                $abilities = [''];
            }

            $tokenResult = $user->createToken('Personal Access Token', $abilities);

            return [
                'message' => $message,
                'user' => ['token' => $tokenResult->plainTextToken, 'user' => new UserResource($user)],
            ];
        } else {
            throw new Exception('Credenciais invalidas');
        }
    }

    public function logout(Request $request)
    {
        $message = MessageEnum::SUCCESS_LOGOUT;

        $user = Auth::user();
        $user->tokens()->delete();

        return ['message' => $message];
    }

    private function getRoleAbilities(int $id)
    {
        $user = AdminRole::find($id);
        $abilities = json_decode($user->abilities, true);
        return $abilities;
    }
}