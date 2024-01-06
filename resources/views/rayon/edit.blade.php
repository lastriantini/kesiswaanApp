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

<form action="{{ route('rayon.update', $id['id']) }}" class="card mt-3 p-5" method="POST" style="max-width: 900px">
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
        <label for="name" class="col-sm-2 col-form-label">Rayon : </label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="rayon" name="rayon" value="{{ old('rayon')}}">
        @error('rayon')
            <div class="text-danger">{{ message }}</div>
        @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="role" class="col-sm-2 col-form-label"> role : </label>
        <div class="col-sm-10">
           <select name="name" id="name" class="form-select">
                <option selected disabled hidden>Pembimbing siswa</option>
                @foreach ($rayons as $item)
                    <option value="{{ $item['name'] }}" {{ old('name') }}>{{ $item['name'] }}</option>
                @endforeach
           </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Data</button>
</form>
@endsection