@extends('layouts.app')
@section('content-auth')
    @if(session()->has('success'))
        <div class="alert alert-success">
           {{session()->get('success')}}
        </div>
    @endif
    <div class="clearfix">
        <a href="{{route('categories.create')}}" class="btn btn-success float-right"
        style="margin-bottom:5px">Add Category</a>
    </div>
    <div class="card card-defult">
        <div class="card-header text-center"><h1>All Categories</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <td><h4>Category Type</h4></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$category->name}}
                                <form action="{{route('categories.destroy',$category->id)}}" method="POSt">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm float-right ml-2">Delete</button>
                                </form>
                                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning btn-sm float-right">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
@endsection
