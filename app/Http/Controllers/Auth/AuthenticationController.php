<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreLoginRequest;
use App\Http\Requests\Auth\StoreRegisterRequest;
use App\Http\Requests\Auth\UpdatePassProfileRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class AuthenticationController extends Controller
{
    private $categories, $posts_latest;

    public function __construct()
    {
        $this->categories = Category::where("is_active", 1)->get();
        $this->posts_latest = Post::latest()->limit(5)->get();
        View::share([
            'categories' => $this->categories,
            'posts_latest' => $this->posts_latest
        ]);
    }
    public function login()
    {
        return view("auth.login");
    }

    public function storeLogin(StoreLoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            if (Auth::user()->role == 2) {
                return redirect()->route("admin.dashboard");
            }
            return redirect()->route("home");
        }
        return back()->withInput($request->validated())->with('error', "Email or Password incorrect");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function storeRegister(StoreRegisterRequest $request)
    {
        $user = User::create($request->validated());
        if ($user) { {
                if (Auth::login($user)) {
                    return redirect()->route("home");
                };
                return redirect()->route("auth.login")->with("error", "Login failed, please try again");
            }
        }
        return back()->with("error", "Create account failed, please try again");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }

    public function showProfile()
    {
        return view("auth.profile");
    }

    public function editProfile()
    {
        return view("auth.edit_profile");
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = User::find(Auth::user()->id);
        if ($request->image) {
            Storage::delete($user->image);
        }
        $user->update($request->validated());
        return redirect()->route("auth.profile")->with("success", "Cập nhật thông tin thành công");
    }

    public function editPass()
    {
        return view("auth.change_pass");
    }

    public function updatePass(UpdatePassProfileRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $user->update(['password' => $request->password]);
        return redirect()->route("auth.profile")->with("success", "Đổi mật khẩu thành công");
    }
}
