<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Todo\StoreTodoRequest;
use App\Models\Deadline;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::latest()->paginate(10);
        return view("admin.pages.todo.index", [
            "todos" => $todos
        ]);
    }

    public function store(StoreTodoRequest $request){
        $expiry = new Carbon($request->expiry);
        try {
            DB::beginTransaction();
            $todo = Todo::create([
                "content" => $request->content,
                "user_id" => auth()->id(),
                "expiry" => $expiry
            ]);
            Deadline::create([
                "deadline" => $expiry->subMinutes(5),
                "todo_id" => $todo->id
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return redirect()->route("admin.todos.index");
    }
}
