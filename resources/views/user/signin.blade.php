@extends('layouts.master')

@section('title')
    Sign In
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign In</h1>
            @if(count($errors))
                <div class="alert alert-danger">
                    @foreach($errors as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>  
            @endif
            <form action="{{ route('user.signin') }}" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
            <p>Don't have an account? <a href="{{ route('user.signup') }}">Sign up instead</a></p>
        </div>
    </div>    
@endsection