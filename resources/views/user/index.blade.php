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

@if (Session::get('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif
@if (Session::get('deleted'))
<div class="alert alert-warning">{{Session::get('deleted')}}</div>
@endif

<div class="container" style="max-width: 80%; margin: -50px 50px 0 0">
    <div class="justify-content-start" style="line-height: 5px; padding-bottom:30px;">
        <h4>Data User</h4>
        <small style="font-size: 12px; color: grey;">home / Data User</small>
    </div>

    <form action="{{ route('user.create') }}" method="get">
        <button type="submit" class="btn btn-secondary float-end">Tambah</button>
    </form>

    <form class="form mb-1 d-inline d-flex align-items-center" action="{{ route('user.index') }}" method="GET">
        <input class="form-control w-25" type="text" name="query" placeholder="Cari rombel...">
        <button class="btn btn-primary ml-1" type="submit">Search</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary ml-1">Clear</a>
    </form>

    <table class="table table-bordered mt-3 align-items-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($users as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['email'] }}</td>
                <td>{{ $item['role'] }}</td>
                <td class="d-flex">
                    <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                    
                    <form action="{{ route('user.delete', $item['id']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button style="margin-right: -80px;" type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        @if ($users->count())
            {{$users->links()}}
        @endif
    </div>

@endsection