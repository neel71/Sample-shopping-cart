@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        @if(count($errors)>0)
        <div class="alert  alert-danger">
            @foreach($errors->all() as $error)
            <p>{{ @error }}</p>
            @endforeach
        </div>
        @endif
        <h1>Sign In</h1>
        <form action="{{route('user.signin')}}" method='POST'>
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control">     
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" id="pass" name="password" class="form-control">     
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
                
        </form>
        <p>Don't have an account?<a href="{{ route('user.signup') }}">Sign Up instead</a></p>
    </div>
</div>
@endsection