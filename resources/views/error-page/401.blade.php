@extends('auth.auth-template', ['class' => 'bg-default'])

@section('page-title')
    Unauthorized
@endsection

@section('content')
    <div class="py-0 text-center" style="
        max-width: 500px;
        padding: 15px;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);">
        <img src="{{ asset('argon') }}/img/brand/unauthorized.png" width="300px" height="300px" alt="..." class="d-flex m-auto ">
        <br>
        <div class="text-light h1">
            You do not have access to this page
        </div>
        <div class="text-light h4">
            Please ask superadmin to grant you the access to this page
        </div>
        <br>
        <a href="{{'login'}}" class="text-center btn btn-light text-dark" style="text-decoration: none">Back to dashboard</a>
    </div>
    
@endsection
