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

    /**
     * Return view ke post index yang dimana
     * pada view itu kita juga me-render datatables 
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

    /**
     * Return view ke post create untuk proses input data
     * ke tabel post.Selain itu kita juga memanggil model create
     * untuk menampilkan data category pada form create post.
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

    /**
     * Proses store data ke tabel post
     */
    public function store(PostRequest $request)
    {
        /**
         * Proses validasi data sebelum melakukan store data ke tabel post
         */
        $dataPostRequest = $request->validated();

        $post = new Post;

        /**
         * Jika terdapat file gambar yang akan disimpan jalankan proses simpan 
         * gambar tersebut. Gambar akan disimpan ke folder public/uploads
         */
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

        /**
         * Redirect ke halaman post.index setelah proses simpan
         * Data ke tabel post
         */
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
        /**
         * Panggil form edit dan tampilkna juga data dari model 
         * Post dan category pada form tersebut
         */
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
        /**
         * Lakukan proses validasi ke PostRequest
         */
        $dataPostRequest = $request->validated();
        
        /**
         * Cari data yang sesuai dengan data yang dipilih
         */
        $post = Post::findOrFail($post->id);

        /**
         * Jika gambar akan diupdate
         * hapus gambar sebelumnya kemudian 
         * ipdate dnegna gambar yangh baru.
         */
        if ($request->hasFile('image')) {
            if (File::exists($post->image)) {
                File::delete($post->image);
            }
            $file = $request->file('image');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/', $uploadFile);
            $post->image = $uploadFile;
        }

        /**
         * Lakukan proses update data
         */
        $post->update([
            'title' => $dataPostRequest['title'],
            'slug' => Str::slug($request->title, '-'),
            'content' => $dataPostRequest['content'],
            'category_id' => $dataPostRequest['category_id']
        ]);

        /**
         * Jika proses update data berhasil kembali ke halaman 
         * post index.
         */
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
        /**
         * Jalankan proses hapus data gambar berdasarkan data yang dipilih 
         * untuk di hapus
         */
        $post = Post::findOrFail($id);
        if (File::exists("uploads/".$post->image)) {
            File::delete("uploads/".$post->image);
        }

        /**
         * Hapus data post dari tabel
         * lalu kembali ke halaman post.index
         */
        $post->delete();
        return to_route('post.index')->with('status','Data Has been Delete');
    }
}
