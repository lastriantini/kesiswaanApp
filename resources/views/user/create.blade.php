@extends('layouts.template')

@section('content')
<style>
    body {
        background-color: white;
        max-width: 100%;
        margin: 0 auto;
        overflow-x: hidden;
    }
</style>
<form action="{{ route('user.store') }}" class="card mt-3 p-5" method="POST" style="max-width: 900px">
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {{--kalai kedeteksi ada with session namanya 'siccess' pas masuk ke halaman ini, msg nya bakal simunculin disini--}}
    @if (Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    {{--token syarat kirim data (agar sistem membaca bahwa data ini berasal dari sumber yang sah)--}}
    @csrf
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Name : </label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
        @error('name')
            <div class="text-danger">{{ message }}</div>
        @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Email : </label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="email" value="{{ old('email')}}">
        @error('email')
            <div class="text-danger">{{ message }}</div>
        @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="role" class="form-label">Role</label>
        <div class="col-sm-10">
            <select name="role" id="role" class="form-control">
                <option selected hidden disabled>Pilih</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="ps" {{ old('role') == 'ps' ? 'selected' : '' }}>Pembimbing Siswa</option>
            </select>
        </div>
    </div>  
    <button type="submit" class="btn btn-primary">Kirim Data</button>
</form>
@endsection