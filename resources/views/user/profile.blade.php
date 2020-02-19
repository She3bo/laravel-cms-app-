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
            <a href="{{route('users.edit',$user->id)}}" class="btn btn-success float-right"
            style="margin-bottom:5px">Edit Your Info</a>
    </div>

    <div class="card card-defult">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td><h4>Image</h4></td>
                            <td><h4>Name</h4></td>
                            <td><h4>Email</h4></td>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>
                                    <img src="{{$user->getGravatar()}}" style="border-radius:50%" width="60px" height="60px">
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td> 
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
