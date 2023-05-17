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

class HomeController extends Controller
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
        $posts = Post::where("is_active", 1)->with(["user", "category"])->latest()->paginate(5);
        $posts_hilight = Post::where("is_check", 1)->get();
        return view("home", [
            'posts' => $posts,
            'posts_hilight' => $posts_hilight,
        ]);
    }

    public function showCategory($slug)
    {
        $posts = Post::where("is_active", 1)->with("user")->get();
        $posts_popular = $posts->sortBy([['view', 'desc'], ['created_at', 'desc']])->slice(0, 5);
        $posts_trending = $posts->sortBy([['created_at', 'desc'], ['view', 'desc']])->slice(0, 5);
        $category = Category::where("slug", $slug)->first();
        if ($category == null) {
            view("pages.details_post", [
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
        $posts = Post::where("is_active", 1)->get();
        $post = $posts->firstWhere('slug', $slug);
        $posts_popular = $posts->sortBy([['view', 'desc'], ['created_at', 'desc']])->slice(0, 5);
        $posts_trending = $posts->sortBy([['created_at', 'desc'], ['view', 'desc']])->slice(0, 5);
        if ($post == null) {
            view("pages.details_post", [
                "error" => "Bài viết không tồn tại hoặc đã bị xoá",
                'posts_popular' => $posts_popular,
                'posts_trending' => $posts_trending,
            ]);
        }
        // DB::table("posts")->whereSlug($slug)->update(['view' => ++$post->view]);
        $post->updateQuietly(['view' => ++$post->view]);
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

    public function updateComment(StoreCommentRequest $request, Comment $comment)
    {
        $validated = $request->validated();
        if ($comment->update($validated)) {
            return back();
        }
        return back()->withInput($request->validated())->with("error", "Cập nhật bình luận thất bại vui lòng thử lại");
    }

    public function about()
    {
        return view("pages.about");
    }

    public function contact()
    {
        return view("pages.contact");
    }

    public function storeContact(StoreContactRequest $request)
    {
        if (Contact::create($request->validated())) {
            return redirect()->route("contact")->with("success", "Cảm ơn bạn đã đóng góp ý kiến!");
        }
        return back()->withInput($request->validated())->with("error", "Có vẻ đã sảy ra lỗi! Bạn có thể thử lại");
    }
}
