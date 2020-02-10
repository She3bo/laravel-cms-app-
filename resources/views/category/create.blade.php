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
       <div class="card-header">{{isset($category)? "Update Category":"Add a new Category" }}</div>
       <div class="card-body">
            <form action="{{isset($category)? route('categories.update',$category->id):route('categories.store')}}" method="post">
                @csrf
                @if(isset($category))
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="category-name">Category Name : </label>
                    <input id="category-name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Add a new category" value = "{{isset($category)? $category->name:'' }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                   <button type="submit" class="btn btn-primary">{{isset($category)? "Update":"Add" }}</button>
            </form>

       </div>
    </div>
@endsection