@extends('layouts.master')

@section('title')
    Sign Up
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign Up</h1>
            @if(count($errors))
                <div class="alert alert-danger">
                    @foreach($errors as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>  
            @endif
            <form action="{{ route('user.signup') }}" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>
    </div>    
@endsection
