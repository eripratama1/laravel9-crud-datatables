<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get();
        return view('post.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $dataPostRequest = $request->validated();

        $post = new Post;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/', $uploadFile);
            $post->image = $uploadFile;
        }

        $post->title = $dataPostRequest['title'];
        $post->slug = Str::slug($request->title, '-');
        $post->content = $dataPostRequest['content'];
        $post->category_id = $dataPostRequest['category_id'];
        $post->save();
        return to_route('post.index')->with('status', 'Data has been stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category = Category::get();
        return view('post.edit', [
            'post' => $post,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $dataPostRequest = $request->validated();
        //$path = $request->hasFile('image');
        $post = Post::findOrFail($post->id);

        if ($request->hasFile('image')) {
            if (File::exists($post->image)) {
                File::delete($post->image);
            }
            $file = $request->file('image');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/', $uploadFile);
            $post->image = $uploadFile;
        }

        $post->update([
            'title' => $dataPostRequest['title'],
            'slug' => Str::slug($request->title, '-'),
            'content' => $dataPostRequest['content'],
            'category_id' => $dataPostRequest['category_id']
        ]);
        return to_route('post.index')->with('status', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (File::exists("uploads/".$post->image)) {
            File::delete("uploads/".$post->image);
        }
        $post->delete();
        return to_route('post.index')->with('status','Data Has been Delete');
    }
}
