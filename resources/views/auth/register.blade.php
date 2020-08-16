@extends('layouts.app')

@section('content')

    {{-- <div class="container" style="max-width: 30rem;">
        <form method="POST" action="{{ route('register') }}" class="form-signin mt-5">
        @csrf
            <h1 class="text-center text-danger mb-3">{{ __('Register') }}</h1>
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-dark">{{ __('Register') }}</button>   
            
            <p class="mt-4">Already have an account? <a href="/login" class="font-weight-bold text-danger">Login</a></p>
        </form>
    </div> --}}

    <div class="container bg-dark text-danger p-3 text-center rounded-lg mt-5">
        <h3>Register option is not available anymore</h3>
    </div>

@endsection()