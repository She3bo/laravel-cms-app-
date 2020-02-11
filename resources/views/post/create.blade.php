@extends('layouts.app')
@section ('trixStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" rel="stylesheet">
@endsection
@section('content-auth')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card card-defult">
       <div class="card-header">Add a new Post</div>
       <div class="card-body">
            <form action="{{isset($post)? route('posts.update',$post->id) : route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="post-name">Title : </label>
                    <input id="post-name" type="text" class="form-control" name="title"  placeholder="title" value = "{{isset($post)? $post->title:''}}">
                </div>
                <div class="form-group">
                    <label for="post-desc">Description : </label>
                    <textarea name="description" id="post-content" class="form-control" cols="30" rows="2" placeholder="description">{{isset($post) ? $post->description:''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content : </label>
                    <textarea name="content" id="post-content" class="form-control" cols="30" rows="3" placeholder="content">{{isset($post) ? $post->content:''}}</textarea>
                    <!-- <input id="x" type="hidden" name="content">
                    <trix-editor input="x">{{isset($post) ? $post->content:''}}</trix-editor> -->
                </div>
                <div class="form-group ">
                    <label for="post-image" class="d-block">Image : </label>
                    <input id="post-image" type="file" name="image" value = "" class="d-block mb-3">
                    <img src="" alt="" width='200px' height='200px'>
                    @if (isset($post))
                        <img src="{{asset('storage/'.$post->image)}}" alt="" width='200px' height='200px'>
                    @endif
                </div>
                   <button type="submit" class="btn btn-primary">Add</button>
            </form>

       </div>
    </div>
@endsection
@section ('trixJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script> 
@endsection