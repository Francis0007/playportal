@extends('layouts.app')

@section('content')
<center>
<div class="loginn">
<a href={{url('/')}}><div class="circle"><p>X</p></div></a>
                <a href={{url('/')}}><img src="{{asset('front_assets/images/playverse color@3x.png')}}" style="height: auto; width: 32%"></a><br>
            <h1>New to PlayVerse? Join now</h1>
        
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                       
                            <label for="name">{{ __('Name') }}</label>

                           
                                <input id="name" placeholder="Full name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <br>
                                @error('name')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        

                       
                            <label for="email" >{{ __('E-Mail Address') }}</label>

                           
                                <input id="email" type="email" placeholder="Email address" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <br>
                                @error('email')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                                    

                       
                            <label for="password">{{ __('Password') }}</label>

                           
                                <input id="password" type="password" placeholder="Password" name="password" required autocomplete="new-password">
                                <br>
                                @error('password')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        
                              
                       
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                           
                                <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                            
                        

                       <br>
                           
                                <button type="submit">
                                    {{ __('Register') }}
                                </button>
                            
                        <br>
                        <p style="text-align: center">Existing User Login Here <a href="{{('login')}}" style="font-size: 20px; text-decoration: underline;">Login</a></p>
                    </form>
</div>
</center>
            
        
    

@endsection
