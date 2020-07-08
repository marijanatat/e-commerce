@extends('layout')

@section('title', 'My profile')


@section('content')

@component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>My profile</span>
    @endcomponent

    <div class="container">
        @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif
    
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>

<div class="products-section container">
    <div class="sidebar">
        <ul>
            <li class="active"><a href="{{ route('users.edit') }}">My profile</a> </li>
            <li class="active"><a href="{{route('orders.index')}}">My orders</a></li>
            
        </ul>
    </div> <!-- end sidebar -->
    <div>
        <div class="products-header">
            <h1 class="stylish-heading">My profile</h1>
        </div>

        <div >
            

            <form action="{{ route('users.update') }}" method="POST">
                {{ csrf_field() }}
                @method('PATCH')
                <div class="form-control">
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" required>
                </div>
                <div class="form-control">
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
                </div>
                <div class="form-control">
                    <input id="password" type="password" name="password" placeholder="Password">
                    <div>Leave password blank to keep current password</div>
                </div>
                <div class="form-control">
                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <div>
                    <button type="submit" class="my-profile-button">Update Profile</button>
                </div>
            </form>
        </div>

        </div> <!-- end products -->
        <div class="spacer">

          
        </div>
    </div>
</div>


@endsection

