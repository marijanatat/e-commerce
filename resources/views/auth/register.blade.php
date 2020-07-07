@extends('layout')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="auth-pages">
        <div class="auth-left">
            @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
            @endif @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h2>Create account</h2>
            <div class="spacer"></div>

            <form action="{{ route('register') }}" method="POST">
                {{ csrf_field() }}
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <input type="password" id="password" name="password"  placeholder="Password" required>
                <input type="password" id="password-confirm" name="password-confirm"  placeholder="Confirm Password" required>

                <div class="login-container">
                    <button type="submit" class="auth-button">Create Account</button>
                    <div class="already-have-container">
                        <p><strong>Already have an account?</strong></p>
                        <a href="{{ route('login') }}">Login</a>
                    </div>
                </div>

                <div class="spacer"></div>

            </form>
        </div>

        <div class="auth-right">
            <h2>Benefits</h2>
            <div class="spacer"></div>
            <p><strong>Save time now.</strong></p>
            <p>You don't need an account to checkout.</p>
            <div class="spacer"></div>
        
            &nbsp;
            <div class="spacer"></div>
            <h2>Loyality Program</h2>
            &nbsp;
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt debitis, amet magnam accusamus nisi distinctio eveniet ullam. Facere, cumque architecto.</p>

        </div>
    </div>
</div>
@endsection