<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SocialService
{
    public function handleLoginWithSocial($info, $social)
    {

        $users = User::where("email", $info->email)->get();
        $user = false;
        if (!$users->count() != 0) {
            foreach ($users as $u) {
                if ($u->socialite == $social) {
                    $user = $u;
                }
            }
        }
        if (!$user) {
            $user = User::create([
                "name" => $info->name ?? uniqid(),
                "email" => $info->email,
                "socialite" => $social
            ]);
        }
        return $user;
    }
}
