@extends('layouts.app', ['title' => 'Create User'])

{{-- title web tab --}}
@section('page-title')
    Create User
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Create User
@endsection --}}

@section('content')
    @include('layouts.headers.cards')
    @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
    @elseif(Session::has('failed'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{Session::get('failed')}}</strong>
        </div>
    @endif
    <div class="container-fluid">
        <div class="rounded border mt-4 mb-4 p-4" style="background-color: #fff">
            <div class="font-weight-bold">
                <div class="mb-3">
                    <h3>Create User</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/store/user" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" placeholder="Input Username" @error('username')
                        is invalid @enderror name="username" value="">
                        @error('username')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" placeholder="Input Name" @error('name')
                        is invalid @enderror name="name" value="">
                        @error('name')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" type="password" placeholder="Input Password" @error('password')
                        is invalid @enderror name="password" value="">
                        @error('password')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm Password" @error('confirmPassword')
                        is invalid @enderror name="confirmPassword" value="">
                        @error('confirmPassword')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="/user" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Store</button>
                    </div>
                </form>
            </div>
        </div>   
    </div>
@endsection