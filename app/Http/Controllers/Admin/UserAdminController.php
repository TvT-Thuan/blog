<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view("admin.pages.users.index", [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view("admin.pages.users.create");
    }

    public function store(StoreUserRequest $request)
    {
        if (User::create($request->validated())) {
            return redirect()->route("admin.users.index")->with("success", "Create user success");
        }
        return back()->withInput($request->validated())->with("error", "Create user failed please try again");
    }

    public function edit(User $user)
    {
        return view("admin.pages.users.edit", [
            "user" => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user->update($request->validated())) {
            return redirect()->route("admin.users.index")->with("success", "Update user success");
        }
        return back()->withInput($request->validated())->with("error", "Update user failed please try again");
    }

    public function destroy(User $user)
    {
        if($user->role == 2){
            return redirect()->route("admin.users.index")->with("error", "Your not delete account");
        }
        if ($user->delete()) {
            return redirect()->route("admin.users.index")->with("success", "Delele user success");
        }
        return back()->with("error", "Delele user failed please try again");
    }

    public function is_active(User $user, $is_active)
    {
        if ($is_active == 0 || $is_active == 1) {
            if ($user->update(['is_active' => $is_active])) {
                return redirect()->route("admin.users.index")->with("success", "Update user completed");
            };
            return back()->with("error", "Update user failed please try again");
        }
        return back()->with("error", "Update user failed! Status active invalid");
    }
}
