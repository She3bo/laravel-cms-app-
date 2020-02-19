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
    <div class="card card-defult">
        <div class="card-header text-center"><h1>All Users</div>
        @if($users->count()>0)
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td><h4>Image</h4></td>
                            <td><h4>Name</h4></td>
                            <td><h4>Permission</h4></td>
                            <td><h4>control</h4></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <img src="{{$user->getGravatar()}}" style="border-radius:50%" width="60px" height="60px">
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->role}}
                                </td>
                                <td>
                                    @if($user->isAdmin())
                                        <form action="{{route('users.makeWriter',$user->id)}}" method="post" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Make Writer</button>
                                        </form>
                                    @else
                                        <form action="{{route('users.makeAdmin',$user->id)}}" method="post" class="d-inline ">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Make Admin</button>
                                        </form>
                                        <!-- <a href="{{route('users.makeAdmin',$user->id)}}" class="btn btn-warning">Make Admin</a> -->
                                    @endif
                                    <form action="{{route('users.destroy',$user->id)}}" method="post" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger float-right">Delete</button>
                                    </form>
                                </td>
                                
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
