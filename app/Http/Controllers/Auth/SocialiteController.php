<?php

namespace App\Http\Controllers\Auth;

use App\Services\SocialService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public $socialService;
    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }

    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function login($social)
    {
        $info = Socialite::driver($social)->user();
        $user = $this->socialService->handleLoginWithSocial($info, $social);
        if(!$user){
          return back();
        }
      	Auth::login($user);
        return redirect()->route("home");
    }
}
