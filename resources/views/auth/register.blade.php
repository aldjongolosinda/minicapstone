

@extends('landing')

@section('content')
    {{-- <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sign Up</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="card shadow-lg col-md-9 col-lg-6 bg-body-tertiary">
                <div class="p-4 p-md-5">
                    <h4 class="text-center mb-3">Sign Up</h4>
                    <form method="POST" action="{{ route('register') }}" class="mb-5">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" class="form-control rounded" name="name" id="name" placeholder="Full Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" class="form-control rounded" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control rounded" name="password" id="password" placeholder="Password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control rounded" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" required>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign Up</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <p>
                            Already have an account?<a href="/login"> Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
