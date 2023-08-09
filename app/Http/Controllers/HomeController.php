<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreContactRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\AssignOp\Pow;

use function App\Helpers\cacheDatabase;

class HomeController extends Controller
{
    private $categories, $posts_latest;

    public function __construct()
    {
        $this->categories = cacheDatabase("categories", ["slug", "name"]);
        $this->posts_latest = cacheDatabase("posts_latest");
        View::share([
            'categories' => $this->categories,
            'posts_latest' => $this->posts_latest
        ]);
    }

    public function index()
    {
        $posts = cacheDatabase("posts_paginate");
        $sliders =  cacheDatabase("sliders");
        return view("home", [
            'posts' => $posts,
            'posts_hilight' => $sliders,
        ]);
    }

    public function showCategory($slug)
    {
        $posts_popular = cacheDatabase("posts_popular");
        $posts_trending = cacheDatabase("posts_trending");
        $category = Category::where("slug", $slug)->first();
        if ($category == null) {
            return view("pages.details_post", [
                "error" => "Danh mục không tồn tại hoặc đã bị xoá",
                'posts_popular' => $posts_popular,
                'posts_trending' => $posts_trending,
            ]);
        }
        return view("pages.list_post", [
            'category' => $category,
            'posts_popular' => $posts_popular,
            'posts_trending' => $posts_trending,
        ]);
    }

    public function showPost($slug)
    {
        $posts_popular = cacheDatabase("posts_popular");
        $posts_trending = cacheDatabase("posts_trending");
        $post = Post::where([
            ["is_active", 1],
            ["slug", $slug]
        ])->first();
        if (!$post) {
            return view("pages.details_post", [
                "error" => "Bài viết không tồn tại hoặc đã bị xoá",
                'posts_popular' => $posts_popular,
                'posts_trending' => $posts_trending,
            ]);
        }
        DB::table("posts")->whereSlug($slug)->update(['view' => ++$post->view]);
        return view("pages.details_post", [
            'post' => $post,
            'posts_popular' => $posts_popular,
            'posts_trending' => $posts_trending,
        ]);
    }

    public function storeComment(StoreCommentRequest $request, $slug)
    {
        $post = Post::where("slug", $slug)->first();
        $validated = $request->validated();
        $validated['post_id'] = $post->id;
        $validated['user_id'] = Auth::user()->id;
        if (Comment::create($validated)) {
            return back();
        }
        return back()->withInput($request->validated())->with("error", "Bình luận thất bại vui lòng thử lại");
    }

    public function updateComment(StoreCommentRequest $request, $slug, Comment $comment)
    {
        if (!Post::where("slug", $slug)->first()) {
            return redirect()->route("home");
        };
        $validated = $request->validated();
        if ($comment->update($validated)) {
            return redirect()->route("show.posts", $slug)->with("success", "Cập nhật bình luận thành công");
        }
        return back()->withInput($request->validated())->with("error", "Cập nhật bình luận thất bại vui lòng thử lại");
    }

    public function destroyComment($slug, Comment $comment)
    {
        if ($comment->user_id == auth()->user()->id || auth()->user()->role == 2) {
            if ($comment->delete()) {
                return redirect()->route("show.posts", $slug)->with("success", "Xoá bình luận thành công");
            }
            return redirect()->route("show.posts", $slug)->with("error", "Xoá bình luận thất bại");
        }
        return redirect()->route("show.posts", $slug)->with("error", "Bình luận không phải của bạn!");
    }

    public function about()
    {
        return view("pages.about");
    }

    public function contact()
    {
        return view("pages.contact");
    }

    public function search(Request $request)
    {
        $posts_popular = cacheDatabase("posts_popular");
        $posts_trending = cacheDatabase("posts_trending");
        $key = $request->key;
        if ($key) {
            $posts_results = Post::where('title', 'like', "%{$key}%")->with(["user", "category"])->paginate(5)->appends(['key' => $key]);
            return view("pages.search_result", [
                "posts" => $posts_results,
                'posts_popular' => $posts_popular,
                'posts_trending' => $posts_trending,
                "key" => $key,
            ]);
        }
        return redirect()->route("home");
    }

    public function storeContact(StoreContactRequest $request)
    {
        if (Contact::create($request->validated())) {
            return redirect()->route("contact")->with("success", "Cảm ơn bạn đã đóng góp ý kiến!");
        }
        return back()->withInput($request->validated())->with("error", "Có vẻ đã sảy ra lỗi! Bạn có thể thử lại");
    }
}
