@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Post</div>

                    <div class="card-body">
                        {{-- action form ke route post update untuk proses update data --}}
                        <form action="{{ route('post.update',$post) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="">Post Title</label>
                                <input type="text" name="title" value="{{ $post->title }}"
                                    class="form-control @error('title')
                                    is-invalid
                                @enderror">
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="">Post Category</label>
                                <select name="category_id"
                                    class="form-control @error('category_id')
                                    is-invalid
                                @enderror">
                                    <option value="">Pilih Kategori</option>
                                    {{-- looping data category kemudian tampilkan data kategori yang tersimpan
                                    sesuai dengan nilai yang tersimpan di tabel post menggunakan @selected 
                                    dari blade --}}
                                    @foreach ($category as $itemCategory)
                                        <option @selected($itemCategory->id == $post->category_id) value="{{ $itemCategory->id }}">{{ $itemCategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="">Post Content</label>
                                <textarea name="content"
                                    class="form-control @error('content')
                                    is-invalid
                                @enderror"
                                    id="" cols="30" rows="10">{{$post->content}}</textarea>
                                @error('content')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="">Post Image</label>
                                <input type="file" name="image" value="{{ $post->image }}"
                                    class="form-control @error('image')
                                    is-invalid
                                @enderror">
                                @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3 float-end">
                                <button type="submit" class="btn btn-primary btn-sm">Save Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection