<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // return route("post.create");
        // return redirect("/post/create");
        // return redirect()->route("post.create");
        // return to_route("post.create");

        // dd(Category::find(1)->posts());

        $posts = Post::paginate(5);
        // echo view('dashboard.post.index', ["posts" => $posts]);
        return view('dashboard.post.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();
        // dd($categories);
        return view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        // echo request('title');
        // dd(request('title'));
        // echo $request->input('slug');
        // dd( $request );
        // dd($request->all());

        // $data = array_merge($request->all(), ['image' => '']);

        // dd($data);

        // $validated = $request->validate([
        //     'title' => "required|min:5|max:500",
        //     'slug' => "required|min:5|max:500",
        //     'content' => "required|min:7",
        //     'category_id' => "required|integer",
        //     'description' => "required|min:7",
        //     'posted' => "required",
        // ]);

        // $validated = $request->validate(StoreRequest::myRules());

        // $validated = Validator::make($request->all(), StoreRequest::myRules());
        // dd($validated->errors());
        // dd($validated->fails());

        // $data = $request->validated();
        // $data['slug'] = Str::slug($data['title']);
        // dd($data);



        Post::create($request->validated());
        return to_route("post.index")->with('status', "Resgistro creado.👍😎");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        return view("dashboard.post.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        $categories = Category::pluck('id', 'title');

        // dd($categories);

        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        if ( isset($data["image"])) {

            // dd($request->image);

            // dd($data["image"]->getClientOriginalName());
            // dd($data["image"]->extension());
            $data["image"] = $filename = time().".".$data["image"]->extension();
            // dd($filename);

            $request->image->move(public_path("images/otros"), $filename);
        }

        $post->update($data);
        // $request->session()->flash('status', "Resgistro actualizado ");
        return to_route("post.index")->with('status', "Resgistro actualizado.👍😎");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        // echo "destroy";
        $post->delete();
        return to_route("post.index")->with('status', "Resgistro eliminado.👍😎");
    }
}
