@extends('layouts.app')

@section('content')
<center>
<div class="login">

                <a href={{url('/')}}><div class="circle"><p>X</p></div></a>
                <a href={{url('/')}}><img src="{{asset('front_assets/images/playverse color@3x.png')}}" style="height: auto; width: 32%"></a><br>
            <h1>Login</h1>
    

                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                        
                            <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" placeholder="Email address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
<br>
                                @error('email')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                     

    
                            <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" placeholder="Password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
<br>
                                <button type="submit">
                                    {{ __('Login') }}
                                </button><br>

                                @if (Route::has('password.request'))
                                    <a class="under" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                    
                      <br>
                        <p style="text-align: center;">New user register here <a href="{{('register')}}" style="font-size: 20px; text-decoration: underline;">Register</a></p>
                    </form>

</center>
@endsection
