<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index',['posts'=>Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image->store('images','public')
        ]);
        session()->flash('success','Post Created Successfully');
        return redirect('posts');
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
        return view('post.create')->withPost($post);
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
        echo "A7a";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post = Post::withTrashed()->where('id',$id)->first();
       // dd($post);
        if($post->trashed()){
            $post->forceDelete();
            Storage::disk('public')->delete($post->image);
            session()->flash('success','Post deleted Successfully');
            return redirect('/trashed');
        }else{
            $post->delete();
            session()->flash('success','Post Trashed Successfully');
            return redirect('posts');
        }
        
    }
    public function trash(){
        $trashedPost = Post::onlyTrashed()->get();
        return view('post.index')->withPosts($trashedPost);
    }
    public function restore($id){
        Post::withTrashed()->where('id',$id)->restore();
        return redirect('posts');
    }
}
