<?php

namespace App\Http\Controllers\Admin;

use App\Events\AcceptPost;
use App\Events\PostChangeActive;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostAdminController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate();
        return view("admin.pages.posts.index", [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $users = User::where("is_active", 1)->get();
        $categories = Category::where('is_active', 1)->get();
        return view("admin.pages.posts.create", [
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    public function store(StorePostRequest $request)
    {
        if (Post::create($request->validated())) {
            return redirect()->route("admin.posts.index")->with("success", "Create post success");
        }
        return back()->withInput($request->validated())->with("error", "Create post failed please try again");
    }

    public function show(Post $post)
    {
    }

    public function edit(Post $post)
    {
        $users = User::where("is_active", 1)->get();
        $categories = Category::where('is_active', 1)->get();
        return view("admin.pages.posts.edit", [
            'users' => $users,
            'categories' => $categories,
            'post' => $post,
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($request->image) {
            Storage::delete($post->image);
        }
        if ($post->update($request->validated())) {
            return redirect()->route("admin.posts.index")->with("success", "Update post success");
        }
        return back()->withInput($request->validated())->with("error", "Update post failed please try again");
    }

    public function destroy(Post $post)
    {
        Storage::delete($post->image);
        if ($post->delete()) {
            return redirect()->route("admin.posts.index")->with("success", "Delele post success");
        }
        return back()->with("error", "Delele post failed please try again");
    }

    public function is_check(Post $post, $is_check)
    {
        if ($is_check == 0 || $is_check == 1) {
            if ($post->update(['is_check' => $is_check])) {
                return redirect()->route("admin.posts.index")->with("success", "Update post completed");
            };
            return back()->with("error", "Update post failed please try again");
        }
        return back()->with("error", "Update post failed! Status active invalid");
    }

    public function is_active(Post $post, $is_active)
    {
        if ($is_active == 0 || $is_active == 1) {
            if ($post->update(['is_active' => $is_active])) {
                if ($post->user_id != auth()->user()->id) {
                    event(new PostChangeActive($post));
                }
                return redirect()->route("admin.posts.index")->with("success", "Update post completed");
            };
            return back()->with("error", "Update post failed please try again");
        }
        return back()->with("error", "Update post failed! Status active invalid");
    }
}
