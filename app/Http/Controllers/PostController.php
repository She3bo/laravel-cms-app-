<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Tag;
use App\User;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkCategory')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin()){
            return view('post.index',['posts'=>Post::all()]);
        }
        return view('post.index',['posts'=>User::find(auth()->user()->id)->posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // dd(Category::all());
        return view('post.create',['categories' => Category::all(),
                                  'tags' => Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
       $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'image' => $request->image->store('images','public')
        ]);
        if($request->tags)
            $post->tags()->attach($request->tags);

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
        return view('post.create',[ 'post'       => $post,
                                    'categories' => Category::all(),
                                    'tags'       => Tag::all()
                                  ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //dd($post);
        $data = $request->only(['title','description','content']);
        if($request->hasFile('image')){
            $image = $request->image->store('images','public');
            Storage::disk('public')->delete($post->image);
            $data['image']= $image;
        }
        if($request->tags)
            $post->tags()->sync($request->tags);
        $post->update($data);
        session()->flash('success','Post Updated Successfully');
        return redirect('posts');
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
            $post->tags()->detach();
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
