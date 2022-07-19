@extends('auth.auth-template', ['class' => 'bg-default'])

@section('page-title')
    Register
@endsection

@section('content')
    <div class="col-lg-6 col-md-8" style="
        max-width: 450px;
        padding: 15px;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);">
        <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="py-0 text-center">
                    <img src="{{ asset('argon') }}/img/brand/logo.png" width="140px" height="110px" alt="..." class="d-flex m-auto ">
                </div>
                <div class="text-center text-muted mb-4">
                    <small>
                            Create new account OR Sign in with these credentials:
                            <br>
                            Username <strong>admin@argon.com</strong> Password: <strong>secret</strong>
                    </small>
                </div>
                <form role="form" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">{{ __('Create account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
