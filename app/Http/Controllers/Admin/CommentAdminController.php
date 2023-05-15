<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comments\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class CommentAdminController extends Controller
{
    public function index()
    {
        $comments = Comment::with(["user", "post"])->paginate();
        return view('admin.pages.comments.index',[
            'comments' => $comments,
        ]);
    }

    public function edit(Comment $comment)
    {
        return view("admin.pages.comments.edit", [
            "comment" => $comment,
        ]);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return redirect()->route("admin.comments.index")->with("success", "Update comment success");
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route("admin.comments.index")->with("success", "Delete comment success");
    }
}
