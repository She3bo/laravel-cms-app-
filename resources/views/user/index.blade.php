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
    <!-- <div class="clearfix">
        <a href="{{route('tags.create')}}" class="btn btn-success float-right"
        style="margin-bottom:5px">Add User</a>
    </div> -->
    <div class="card card-defult">
        <div class="card-header text-center"><h1>All Users</div>
        @if($users->count()>0)
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td><h4>Name</h4></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$user->name}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
           <h4 class="text-center">NO User Yet</h4>
        @endif
        
    </div>
@endsection
