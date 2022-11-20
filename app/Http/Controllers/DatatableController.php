<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
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
