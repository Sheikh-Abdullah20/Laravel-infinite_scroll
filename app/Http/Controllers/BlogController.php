<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::paginate(10);
        return view('welcome', compact('blogs'));
    }


    public function getBlogs(){
        $blogs = Blog::paginate(10);
       
        $html = view('blogs',compact('blogs'))->render();

        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }
}
