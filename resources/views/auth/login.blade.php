@extends('auth.auth-template', ['class' => 'bg-default'])

@section('page-title')
    Login
@endsection

@section('content')
    <div class="col-lg-4 col-md-5" style="
        max-width: 450px;
        padding: 15px;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);">
        <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-4">
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
                <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }} mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83" style="color: #2a3880;"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ __('Username') }}" type="text" name="username" value="admin" required autofocus>
                        </div>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open" style="color: #2a3880;"></i></span>
                            </div>
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="secret" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{-- <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheckLogin">
                            <span class="text-muted">{{ __('Remember me') }}</span>
                        </label>
                    </div> --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-2">{{ __('Sign in') }}</button>
                    </div>
                </form>
            </div>
            {{-- <div class="row pl-3 pr-3 pb-3">
                <div class="col-6">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="">
                            <small>{{ __('Forgot password?') }}</small>
                        </a>
                    @endif
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('register') }}" class="">
                        <small>{{ __('Create new account') }}</small>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
