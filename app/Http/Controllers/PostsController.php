<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->orderBy('updated_at', 'desc')->get();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::pluck('id');
        $category = implode(",", $category->all());

        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'nullable|integer|in:'.$category,
            'file' => 'nullable|max:2000',
        ]);

        $post = new Post;
        $post->name = $request->name;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        if ($request->file) {
            $this->saveFile($request->file, $post);
        }

        return redirect('/posts/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(array('attachableComments' => function($query) 
        {
            $query->orderBy('created_at', 'desc');
        }))
        ->with('category', 'files')
        ->where('id', $id)->first();

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name')->get();
        $post = Post::with('category')->where('id', $id)->first();

        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::pluck('id');
        $category = implode(",", $category->all());
   
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'nullable|integer|in:'.$category,
        ]);

        $post = Post::where('id', $id)->first();
        $post->name = $request->name;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect('/posts/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        $post->delete();

        return redirect('/posts');
    }

    public function addFile(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|max:2000',
        ]);

        $post = Post::where('id', $request->post_id)->first();
        $this->saveFile($request->file, $post);

        return redirect('/posts/'.$post->id);
    }

    public function saveFile($new_file, $post)
    {
        $file = new File;
        $file->name = $new_file->getClientOriginalName();
        $file->file_size = $new_file->getSize();
        $file->post_id = $post->id;
        $file->file_name = 0;
        $file->save();

        Storage::disk('public')->put('posts_files/'.$post->name.'_'.$post->id, $new_file);
    }
}
