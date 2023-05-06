<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // return route("category.create");
        // return redirect("/category/create");
        // return redirect()->route("category.create");
        // return to_route("category.create");

        // dd(Category::find(1)->categories());

        $categories = Category::paginate(5);
        // echo view('dashboard.category.index', ["categories" => $categories]);
        return view('dashboard.category.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();
        // dd($categories);

        return view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Category::create($request->validated());
        return to_route("category.index")->with('status', "Resgistro creado.👍😎");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view("dashboard.category.show", compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        // $request->session()->flash('status', "Resgistro actualizado ");
        return to_route("category.index")->with('status', "Resgistro creado.👍😎");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        // echo "destroy";
        $category->delete();
        return to_route("category.index")->with('status', "Resgistro eliminado.👍😎");
    }
}
