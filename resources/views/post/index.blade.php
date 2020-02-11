@extends('layouts.app')
@section('content-auth')
    @if(session()->has('success'))
        <div class="alert alert-success">
           {{session()->get('success')}}
        </div>
    @endif
    <div class="clearfix">
        <a href="{{route('posts.create')}}" class="btn btn-success float-right"
        style="margin-bottom:5px">Add Post</a>
    </div>
    <div class="card card-defult">
        <div class="card-header text-center"><h1>All Posts</h1></div>
        @if($posts->count()>0)
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>control</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <img src="{{asset('storage/'.$post->image)}}" alt="" width="80px" height='90px'> 
                                </td>
                                <td >
                                    {{$post->title}}
                                </td>
                                <td> 
                                    @if(!$post->trashed())
                                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-warning btn-sm float-left mr-2">Edit</a>
                                    @else
                                        <a href="{{route('restore',$post->id)}}" class="btn btn-warning btn-sm float-left mr-2">Restor</a>
                                    @endif
                                    <form action="{{route('posts.destroy',$post->id)}}" method="POSt">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">{{$post->trashed() ? "Delete":"Trash"}}</button>
                                    </form>

                                    
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div><h1>No Posts Yet.</h1></div>
        @endif
    </div>
@endsection
