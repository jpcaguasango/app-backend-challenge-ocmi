<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Model
{
    public static function generateToken($user)
    {
        // Delete tokens available
        // $user->tokens()->delete();

        //Generate Token
        $permissions = User::getPermissions($user);
        $token = $user->createToken('token.' . $user->username, $permissions)->accessToken;


        return $token;
    }

    public static function getAuthUserName()
    {
        $user = Auth::user();
        return $user ? $user->username : null;
    }

    public static function getAuthAccountId()
    {
        $user = Auth::user();
        return $user ? $user->account->id : null;
    }

    public static function getAuthUserId()
    {
        $user = Auth::user();
        return $user ? $user->id : null;
    }
}
