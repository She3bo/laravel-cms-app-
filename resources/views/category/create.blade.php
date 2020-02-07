@extends('layouts.app')
@section('content-auth')
    <div class="card card-defult">
       <div class="card-header">Add a new Category</div>
       <div class="card-body">
            <form action="{{route('categories.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="category-name">Category Name : </label>
                    <input type="text" class="form-control" name="name" id="category-name" placeholder="Add a new category">
                </div>
                   <button type="submit" class="btn btn-primary">Add</button>
            </form>
       </div>
    </div>
@endsection