@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 30rem;">
  <form method="POST" action="{{ route('login') }}" class="form-signin mt-5">
    @csrf
    <h1 class="text-center text-danger mb-3">{{ __('Login') }}</h1>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

      @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
    <div class="form-group form-check">
      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

      <label class="form-check-label" for="remember">
          {{ __('Remember Me') }}
      </label>
    </div>
    <div>
      <button type="submit" class="btn btn-dark">{{ __('Login') }}</button>
      @if (Route::has('password.request'))
          <a class="btn btn-link text-decoration-none text-danger" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
          </a>
      @endif
    </div>

    {{-- <div>
      <p class="mt-4">Want to create a new account? <a href="/register" class="font-weight-bold text-danger">Register</a></p>
    </div> --}}
  </form>
</div>

@endsection