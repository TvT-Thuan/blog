<?php

use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Mail\Registed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, "index"])->name("home");

Route::get("/categories/{slug}", [HomeController::class, "showCategory"])->name("show.categories");
Route::get("/posts/{slug}", [HomeController::class, "showPost"])->name("show.posts");
Route::get("/about", [HomeController::class, "about"])->name("about");
Route::get("contact", [HomeController::class, "contact"])->name("contact");
Route::post("contact", [HomeController::class, "storeContact"])->name("store.contact");

// Route::get("/test", function (Request $request) {
//     Mail::to(Auth::user()->email)->later(now()->addSeconds(5), new Registed(Auth::user()));
// });

Route::middleware("guest")->group(function () {
    Route::get("login", [AuthenticationController::class, 'login'])->name("auth.login");
    Route::post("login", [AuthenticationController::class, 'storeLogin'])->name("auth.store.login");
    Route::get("register", [AuthenticationController::class, 'register'])->name("auth.register");
    Route::post("register", [AuthenticationController::class, 'storeRegister'])->name("auth.store.register");
});

Route::middleware("auth")->group(function () {
    // logout
    Route::get("logout", [AuthenticationController::class, 'logout'])->name("auth.logout");
    // commnet
    Route::post("/posts/{slug}", [HomeController::class, "comment"])->name("comment.posts");

    Route::resource("/my-posts", PostController::class);
    Route::get("/my-posts/{slug}/{is_check}", [PostController::class, "is_active"])->name("my-posts.is_active");

    Route::get("/profile", [AuthenticationController::class, "showProfile"])->name("auth.profile");
    Route::get("/profile/edit", [AuthenticationController::class, "editProfile"])->name("auth.edit.profile");
    Route::put("/profile", [AuthenticationController::class, "updateProfile"])->name("auth.update.profile");

    Route::get("/profile/change-pass", [AuthenticationController::class, "editPass"])->name("auth.edit_password.profile");
    Route::put("/profile/change-pass", [AuthenticationController::class, "updatePass"])->name("auth.update_password.profile");
    Route::prefix("admin")->middleware("check_supper_admin")->name("admin.")->group(function () {
        // dashboard
        Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");
        // users
        Route::resource("users", UserAdminController::class)->except("show");
        Route::get("users/{user}/{is_active}", [UserAdminController::class, "is_active"])->name("users.is_active");
        //categories
        Route::resource("categories", CategoryAdminController::class)->except("show");
        Route::get("categories/{category}/{is_active}", [CategoryAdminController::class, "is_active"])->name("categories.is_active");
        //posts
        Route::resource("posts", PostAdminController::class)->except("show");
        Route::get("posts/{post}/{is_check}", [PostAdminController::class, "is_check"])->name("posts.is_check");
        Route::get("posts/{post}/{is_active}", [PostAdminController::class, "is_active"])->name("posts.is_active");
        //comment
        Route::resource("comments", CommentAdminController::class)->except(["show,create,store"]);
        //contact
        Route::get("contacts", [ContactAdminController::class, "index"])->name("contacts.index");
        Route::get("contacts/{contact}", [ContactAdminController::class, "show"])->name("contacts.show");
        Route::delete("contacts/{contact}", [ContactAdminController::class, "destroy"])->name("contacts.destroy");
        Route::post("contacts/reply", [ContactAdminController::class, "reply"])->name("contacts.reply");
    });
});
