@extends('layouts.app')

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
       <div class="card-header">Edit Your Info</div>
       <div class="card-body">
            <form action="route('users.update',$user->id)" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="user-name">Name : </label>
                    <input id="user-name" type="text" class="form-control" name="username"  placeholder="username" value = "{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="user-email">Email : </label>
                    <input id="user-email" type="email" class="form-control" name="email"  placeholder="email" value = "{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="user-password">Password : </label>
                    <input id="user-password" type="password" class="form-control" name="password"  placeholder="password" value = "{{$user->password}}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
       </div>
    </div>
@endsection
