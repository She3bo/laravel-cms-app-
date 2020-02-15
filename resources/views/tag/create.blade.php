@extends('layouts.app')
@section('content-auth')
<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

    <div class="card card-defult">
       <div class="card-header">{{isset($tag)? "Update Tag":"Add a new Tag" }}</div>
       <div class="card-body">
            <form action="{{isset($tag)? route('tags.update',$tag->id):route('tags.store')}}" method="post">
                @csrf
                @if(isset($tag))
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="category-name">Tag Name : </label>
                    <input id="category-name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Add a new tag" value = "{{isset($tag)? $tag->name:'' }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                   <button type="submit" class="btn btn-primary">{{isset($tag)? "Update":"Add" }}</button>
            </form>

       </div>
    </div>
@endsection