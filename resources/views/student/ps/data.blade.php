{{-- panngil file template --}}
@extends('layouts.template')

{{-- isi bagian yield --}}
@section('content')
    <style>
        body {
            background-color: white;
            max-width: 100%;
            margin: 0 auto;
            overflow-x: hidden;
        }
    </style>

<div class="container" style="max-width: 80%; margin: 0 50px 0 0">
    <div class="justify-content-start" style="line-height: 5px; padding-bottom:30px;">
        <h4>Data Siswa</h4>
        <small style="font-size: 12px; color: grey;">home / Data Siswa</small>
    </div>

    <form class="form mb-1 d-inline d-flex align-items-center" action="{{ route('ps.student.data') }}" method="GET">
        <input class="form-control w-25" type="text" name="query" placeholder="Cari siswa...">
        <button class="btn btn-primary ml-1" type="submit">Search</button>
        <a href="{{ route('student.index') }}" class="btn btn-secondary ml-1">Clear</a>
    </form>

    <table class="table table-bordered mt-3 align-items-center">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $item)
            <tr>
                <td>{{ ($students->currentpage()-1) * $students->perpage() + $loop->index +1 }}</td>
                <td>{{ $item['nis'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['rombel']['rombel'] }}</td>
                <td>{{ $item['rayon']['rayon'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        @if ($students->count())
            {{$students->links()}}
        @endif
    </div>

</div>

@endsection