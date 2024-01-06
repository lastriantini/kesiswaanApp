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
<form action="{{ route('student.store') }}" class="card mt-3 p-5" method="POST" style="max-width: 900px">
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
        <label for="nis" class="col-sm-2 col-form-label">NIS : </label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis')}}">
        @error('nis')
            <div class="text-danger">{{ message }}</div>
        @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama : </label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
        @error('name')
            <div class="text-danger">{{ message }}</div>
        @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-10">
           <select name="rombel" id="rombel" class="form-select">
                <option selected disabled hidden>Pilih Rombel</option>
                @foreach ($students as $item)
                    <option value="{{ $item['rombel']['rombel'] }}" {{ old('rombel') }}>{{ $item['rombel']['rombel'] }}</option>
                @endforeach
           </select>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-10">
           <select name="rayon" id="rayon" class="form-select">
                <option selected disabled hidden>Pilih Rayon</option>
                @foreach ($students as $item)
                    <option value="{{ $item['rayon']['rayon'] }}" {{ old('rayon') }}>{{ $item['rayon']['rayon'] }}</option>
                @endforeach
           </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Data</button>
</form>
@endsection