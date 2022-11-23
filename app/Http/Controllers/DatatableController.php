<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class DatatableController extends Controller
{

    /**
     * Method post pada Datatable controller
     * digunakan untuk me-render data dengan datatable secara serverside
     * dimana kita menambahkan beberapa kolom yaitu
     * 1.Kolom action untuk menampilkan tombol action edit dan hapus
     * 2.Kolom category untuk menampilkan data category yang berelasi antara tabel post dan category
     * 3.Kolom image untuk menampilkan gambar yang disimpan ke folder public
     */
    public function posts()
    {
        $post = Post::latest()->with('getCategory')->get();
        return datatables()->of($post)
            ->addColumn('action', 'post.action')

            ->addColumn('category', function (Post $model) {
               return $model->getCategory->name;
            })

            ->editColumn('image', function (Post $model) {
                return '<img src="' . $model->getImage() . '" height="80px" />';
            })

            ->addIndexColumn()
            ->rawColumns(['action', 'image'])
            ->toJson();
    }
}
