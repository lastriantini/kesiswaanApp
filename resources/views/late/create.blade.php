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
<form action="{{ route('late.store') }}" enctype="multipart/form-data" class="card mt-3 p-5" method="POST" style="max-width: 900px">
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
        <div class="col-sm-10">
        <option disabled hidden>Pilih Siswa </option>
           <select name="name" id="name" class="form-select">
                @foreach ($lates as $item)
                    <option value="{{ $item['name'] }}" {{ old('name') }}>{{ $item['name'] }}</option>
                @endforeach
           </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="tgl" class="col-sm-2 col-form-label">Tanggal : </label>
        <div class="col-sm-10">
        <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late" value="{{ old('date_time_late')}}">
        @error('date_time_late')
            <div class="text-danger">{{ message }}</div>
        @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="information" class="col-sm-2 col-form-label">Keterangan : </label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="information" name="information" value="{{ old('information')}}">
        @error('information')
            <div class="text-danger">{{ message }}</div>
        @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="file" class="col-sm-2 col-form-label">Upload File :</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="bukti" name="bukti">
            @error('bukti')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
@endsection