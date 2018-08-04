<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\addCategoryRequest;
use App\Http\Requests\updateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }


    public function index()
    {
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    // show filtered posts by category
    public function show(Category $category){
        $posts = $category->posts()->where('status',1)->latest()->get();
        $categories = Category::all();
        return view('welcome', compact('posts','categories'));
    }

    public function create()
    {
        return view('category.create');
    }


    public function store(addCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('listCategories')->with(['message' => 'Category successfully created!']);
    }

    public function edit($category)
    {
        $category = Category::find($category);

        return view('category.update', compact('category'));
    }

    public function update($category, updateCategoryRequest $request)
    {
        $category = Category::find($category);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('listCategories')->with(['message' => 'Category Successfully Updated!']);
    }

    public function destroy($category)
    {
        Category::find($category)->delete();

        return redirect()->route('listCategories')->with(['message' => 'Category Successfully deleted!']);
    }
}
