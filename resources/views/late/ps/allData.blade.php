
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

<div class="navbar" style="margin-top: 50px; padding-top: -50px;">
    <ul class="nav nav-tabs" style="margin-top: -70px; padding-top: -50px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('ps.late.rekap') }}">Rekapitulasi Data</a>
        </li>
    </ul>
</div>
<div class="container" style="max-width: 80%; margin: 0 50px 0 0">

    <div class="justify-content-start" style="line-height: 5px; padding-bottom:30px;">
        <h4>Data Keterlambatan</h4>
        <small style="font-size: 12px; color: grey;">home / Data Keterlambatan</small>
    </div>

    <form action= {{ route('late.create') }} method="get">
        @if(Auth::user()->role =="admin")
        <button type="submit" class="btn btn-secondary float-end">Tambah</button>
        @endif
        <a href="{{ route('ps.late.export-excel') }}" class="btn btn-primary float-end me-3">Export Data (excel)</a>
    </form>
    
    <form class="form mb-1 d-inline d-flex align-items-center" action="#" method="GET">
        <input class="form-control w-25" type="text" name="query" placeholder="Cari keterlambatan...">
        <button class="btn btn-primary ml-1" type="submit">Search</button>
        <a href="#" class="btn btn-secondary ml-1">Clear</a>
    </form>

    <table class="table table-bordered mt-3" style="text-align: center;">
        <thead>
            <tr>
                <th>No</th>
                <th>nama</th>
                <th>tanggal</th>
                <th>informasi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($lates as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['student']['nis'] }} <br> {{ $item['student']['name'] }}</td>
                <td>{{ $item['date_time_late'] }}</td>
                <td>{{ $item['information'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        @if ($lates->count())
            {{$lates->links()}}
        @endif
    </div>
</div>

@endsection