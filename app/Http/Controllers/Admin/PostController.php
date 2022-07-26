<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $posts = Post::paginate($perPage);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:100',
            'slug'      => 'required|string|max:100|unique:posts',
            'category_id'  => 'required|integer|exists:categories,id',
            'tags'      => 'nullable|array',
            'tags.*'    => 'integer|exists:tags,id',
            'image'     => 'required_without:content|nullable|url',
            'content'   => 'required_without:image|nullable|string|max:5000',
        ]);

        $data = $request->all();
        dump($data);

        // salvataggio
        $post = Post::create($data);
        $post->tags()->sync($data['tags']);

        // redirect
        return redirect()->route('admin.posts.show', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        $checkCategory = false;
        $i = 0;
        do {
            if ($post->category_id === $categories[$i]->id) {
                $category = $categories[$i]->name;
                $checkCategory = true;
            }
            $i++;
        } while (!$checkCategory);
        return view('admin.posts.show', [
            'post' => $post,
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
