@extends('layouts.app')
@section('content-auth')
    @if(session()->has('success'))
        <div class="alert alert-success">
           {{session()->get('success')}}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-success">
           {{session()->get('error')}}
        </div>
    @endif
    <div class="clearfix">
        <a href="{{route('tags.create')}}" class="btn btn-success float-right"
        style="margin-bottom:5px">Add Tag</a>
    </div>
    <div class="card card-defult">
        <div class="card-header text-center"><h1>All Tags</div>
        @if($tags->count()>0)
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td><h4>Tag Type</h4></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>
                                    {{$tag->name}}
                                    <form action="{{route('tags.destroy',$tag->id)}}" method="POSt">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm float-right ml-2">Delete</button>
                                    </form>
                                    <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-warning btn-sm float-right">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
           <h4 class="text-center">NO Tags Yet</h4>
        @endif
        
    </div>
@endsection
