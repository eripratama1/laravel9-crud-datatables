@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Post</div>

                    <div class="card-body">
                        {{-- action form ke route post.store untuk proses simpan data ke database  --}}
                        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Post Title</label>
                                <input type="text" name="title"
                                    class="form-control @error('title')
                                    is-invalid
                                @enderror">

                                {{-- Menampilkan pesan error validasi --}}
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
                                
                                {{-- Looping data category dari tabel category --}}
                                <option value="">Pilih Kategori</option>
                                    @foreach ($category as $itemCategory)
                                        <option value="{{ $itemCategory->id }}">{{ $itemCategory->name }}</option>
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
                                    id="" cols="30" rows="10"></textarea>
                                @error('content')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="">Post Image</label>
                                <input type="file" name="image"
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