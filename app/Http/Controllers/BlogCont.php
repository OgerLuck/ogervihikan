<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;

class BlogCont extends Controller{
    
    public function showList(){
        $blogs= Blog::all();
        return view('blog-list', compact('blogs'));
    }

    public function showContent($link){
    	$blogs= Blog::where('link', $link)->first();
        $title = $blogs->title;
    	$content = $blogs->content;
        $identifier = $blogs->ID;
        $date = date_format($blogs->created_at, "d F Y");
        return view('blog-content', compact('title', 'content', 'link', 'identifier', 'date'));
    }

    public function insert(Request $request){
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $shortDesc = implode(' ', array_slice(explode(' ', $request->content), 0, 50));
        $shortDesc = $shortDesc.'</p>';
        $blog->shortDesc = $shortDesc;
        $link = implode('-', explode(' ', $request->title));
        $blog->link = $link;
        $blog->save();
        return view('admin');
    }

    public function update(){

    }

    public function delete(){

    }
}