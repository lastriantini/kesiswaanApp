
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

<div class="container" style="max-width: 80%; margin: 0 50px 0 0">

    <div class="justify-content-start" style="line-height: 5px; padding-bottom:30px;">
        <h4>Data Keterlambatan</h4>
        <small style="font-size: 12px; color: grey;">home / Data Keterlambatan / Detail Keterlambatan</small>
    </div>
 @php
     $no = 1
 @endphp
    {{-- <h3>UI</h3><h5></h5> --}}
    <div class="d-flex flex-wrap justify-content-around">
        @foreach($lates as $late)
            <div class="card m-2" style="width: 15rem; ">
                <img style="height: 170px;" src="{{ asset('storage/' . $late->bukti) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Keterlambatan ke - {{ $no++ }}</h5>
                    <p class="card-text">{{ $late->date_time_late }}</p>
                    <p class="card-text" style="color: blue;">{{ $late->information }}</p>
                </div>
            </div>
        @endforeach
    </div> 

@endsection