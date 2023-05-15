<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class PostController extends Controller
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

    public function index()
    {
        $posts = Post::where("user_id", Auth::user()->id)->paginate(5);
        return view("pages.posts.index", [
            "posts" => $posts,
        ]);
    }

    public function create()
    {
        return view("pages.posts.create");
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        if (Post::create($validated)) {
            return redirect()->route("my-posts.index")->with("success", "Create post success");
        }
        return back()->withInput($request->validated())->with("error", "Create post failed please try again");
    }

    public function edit($slug)
    {
        $post = $this->findAndCheck($slug, Auth::user()->id);
        if (!$post) {
            return back()->with('error', 'Bài viết này không tồn tại hoặc không phải của bạn');
        }
        return view("pages.posts.edit", [
            "post" => $post,
        ]);
    }

    public function update(UpdatePostRequest $request, $slug)
    {
        $post = $this->findAndCheck($slug, Auth::user()->id);
        if (!$post) {
            return back()->with('error', 'Bài viết này không tồn tại hoặc không phải của bạn');
        }
        if ($request->image) {
            Storage::delete($post->image);
        }
        if ($post->update($request->validated())) {
            return redirect()->route("my-posts.index")->with("success", "Update post success");
        }
        return back()->withInput($request->validated())->with("error", "Update post failed please try again");
    }

    public function destroy($slug)
    {
        $post = $this->findAndCheck($slug, Auth::user()->id);
        if (!$post) {
            return back()->with('error', 'Bài viết này không tồn tại hoặc không phải của bạn');
        }
        Storage::delete($post->image);
        if ($post->delete()) {
            return redirect()->route("my-posts.index")->with("success", "Delele post success");
        }
        return back()->with("error", "Delele post failed please try again");
    }

    public function is_active($slug, $is_active)
    {
        $post = $this->findAndCheck($slug, Auth::user()->id);
        if ($is_active == 0 || $is_active == 1) {
            if ($post->update(['is_active' => $is_active])) {
                return redirect()->route("my-posts.index")->with("success", "Update post completed");
            };
            return back()->with("error", "Update post failed please try again");
        }
        return back()->with("error", "Update post failed! Status active invalid");
    }

    public function findAndCheck($slug, $user_id)
    {
        $post = Post::where([
            ["slug", $slug],
            ['user_id', $user_id]
        ])->first();
        return $post;
    }
}
