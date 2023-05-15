<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryAdminController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view("admin.pages.categories.index", [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = Category::get();
        return view("admin.pages.categories.create", [
            'categories' => $categories,
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        if (Category::create($request->validated())) {
            return redirect()->route("admin.categories.index")->with("success", "Create category success");
        }
        return back()->withInput($request->validated())->with("error", "Create category failed please try again");
    }

    public function edit(Category $category)
    {
        return view("admin.pages.categories.edit", [
            "category" => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($category->update($request->validated())) {
            return redirect()->route("admin.categories.index")->with("success", "Update category success");
        }
        return back()->withInput($request->validated())->with("error", "Update category failed please try again");
    }

    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->route("admin.categories.index")->with("success", "Delele category success");
        }
        return back()->with("error", "Delele category failed please try again");
    }

    public function is_active(Category $category, $is_active)
    {
        if ($is_active == 0 || $is_active == 1) {
            if ($category->update(['is_active' => $is_active])) {
                return redirect()->route("admin.categories.index")->with("success", "Update category completed");
            };
            return back()->with("error", "Update category failed please try again");
        }
        return back()->with("error", "Update category failed! Status active invalid");
    }
}
