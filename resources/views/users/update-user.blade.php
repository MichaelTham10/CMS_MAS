@extends('layouts.app', ['title' => 'Update User'])

{{-- title web tab --}}
@section('page-title')
    Update User
@endsection

{{-- navbar title --}}
{{-- @section('head-title')
    Update User
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
                    <h3>Update User</h3>
                </div>   
                <hr class="mt-0 mb-3"> 
                <form action="/update-user/{{$user->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" placeholder="Input Email" @error('email')
                        is invalid @enderror name="email" value="{{$user->email}}">
                        @error('email')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Name</label>
                        <input class="form-control" type="text" placeholder="Input Name" @error('username')
                        is invalid @enderror name="username" value="{{$user->name}}">
                        @error('username')
                            <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" {{$user->role_id == $role->id  ? 'selected' : ''}}>{{$role->name}}</option>
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