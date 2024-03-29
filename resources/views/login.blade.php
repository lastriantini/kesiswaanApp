{{--panngil file template--}}
@extends('layouts.template')

<div class="margin" style="padding: 200px 100px -100px 100px;">
<form action="{{ route('login.auth') }}" method="POST" class="card p-4" style="margin: 200px 100px;">
    {{--with failed dari controller--}}
    @if (Session::get('failed'))
        <div class="alert alert-danger mt-3">{{ Session::get('failed') }}</div>
    @endif
    @csrf
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label @error('email') is-invalid @enderror">Email : </label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="email" value="{{ old('email')}}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="password" class="col-sm-2 col-form-label @error('password') is-invalid @enderror">password : </label>
        <div class="col-sm-10">
        <input type="password" class="form-control" id="password" name="password" value="{{ old('password')}}">
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
    </div>
    <button type="submit" class= "btn btn-primary btn-block">Login</button>
</form>
</div>

