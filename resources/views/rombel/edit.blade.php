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

    <form action="{{ route('rombel.update', $rombel['id']) }}" method="POST" class="card p-5" style="max-width: 900px">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row ">
            <label for="name" class="col-sm-2 col-form-label">Rombel : </label>
            <div class="col-sm-10">
                <input type="text" name="rombel" id="rombel" class="form-control" value="{{ $rombel['rombel'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection