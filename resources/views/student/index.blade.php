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

    <form action="{{ route('student.create') }}" method="get">
        <button type="submit" class="btn btn-secondary float-end">Tambah</button>
    </form>

    <form class="form mb-1 d-inline d-flex align-items-center" action="{{ route('student.index') }}" method="GET">
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
                <td class="d-flex">
                    {{--atau kalau path parameternya ada lebih dari satu : 
                    route('medicine.edit'),['param1'] => $isi1, 'param2' =>$isi2])--}}
                    <a href="{{ route('student.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                    {{--{{ route('student.edit', $item['id']) }}  --}}
                    
                    <form action="{{ route('student.delete', $item['id']) }}" method="post">
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
        @if ($students->count())
            {{$students->links()}}
        @endif
    </div>

</div>

@endsection