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
    @if(Auth::user()->role =="admin")
    <div class="container" style="max-width: 100%">
        <div class="justify-content-start" style="line-height: 5px;">
            <h4>Dashboard</h4>
            <small style="font-size: 12px; color: grey;">home/dashboard</small>
        </div>
        <div class="cards d-flex flex-row">
            <div class="card bs-emphasis-color-rgb bs-light-rgb"
                style="width: 450px; margin: 20px 15px 0 0 ; padding: 5px; background-color: white;">
                <div class="card-body justify-content-start" style="text-align: left; box-shadow: none;">
                    <h6 class="card-title">Peserta Didik</h6>
                    {{-- jumlah peserta didik --}}
                    <i class="bi bi-person" style="font-size: 30px;"></i>
                    <p style="font-size: 20px; margin: -35px 0 0 50px;">
                    {{ DB::table('students')->count() }}
                    </p>
                </div>
            </div>
            <div class="card"
                style="width: 215px; margin: 20px 15px 0 0 ; padding: 5px; background-color: rgb(255, 255, 255);">
                <div class="card-body justify-content-center" style="text-align: left; box-shadow: none;">
                    <h6 class="card-title">Administrator</h6>
                    {{-- jumlah peserta didik --}}
                    <i class="bi bi-person" style="font-size: 30px;"></i>
                    <p style="font-size: 20px; margin: -35px 0 0 50px;">
                    {{ DB::table('users')->where('role', 'admin')->count() }}
                    </p>
                </div>
            </div>
            <div class="card"
                style="width: 215px; margin: 20px 0 0 0; padding: 5px; background-color: white;">
                <div class="card-body justify-content-end" style="text-align: left; box-shadow: none;">
                    <h6 class="card-title">Pembimbing Siswa</h6>
                    {{-- jumlah peserta didik --}}
                    <i class="bi bi-person" style="font-size: 30px;"></i>
                    <p style="font-size: 20px; margin: -35px 0 0 50px;">
                        {{ DB::table('users')->where('role', 'ps')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="cards d-flex flex-row">
            <div class="card" style="width: 450px; margin: 20px 15px 0 0; padding: 5px; background-color: white;">
                <div class="card-body justify-content-start" style="text-align: left; box-shadow: none;">
                    <h6 class="card-title">Rombel</h6>
                    {{-- jumlah peserta didik --}}
                    <i class="bi bi-person" style="font-size: 30px;"></i>
                    <p style="font-size: 20px; margin: -35px 0 0 50px;">
                    {{ DB::table('rombels')->count() }}
                    </p>
                </div>
            </div>
            <div class="card" style="width: 450px; margin: 20px 0 0 0; padding: 5px; background-color: white;">
                <div class="card-body justify-content-end" style="text-align: left; box-shadow: none;">
                    <h6 class="card-title">Rayon</h6>
                    {{-- jumlah peserta didik --}}
                    <i class="bi bi-person" style="font-size: 30px;"></i>
                    <p style="font-size: 20px; margin: -35px 0 0 50px;">
                    {{ DB::table('rayons')->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->role =="ps")
    <div class="container" style="max-width: 100%">
        <div class="justify-content-start" style="line-height: 5px;">
            <h4>Dashboard</h4>
            <small style="font-size: 12px; color: grey;">home/dashboard</small>
        </div>

        <div class="cards d-flex flex-row">
            <div class="card" style="width: 450px; margin: 20px 15px 0 0; padding: 5px; background-color: white;">
                <div class="card-body justify-content-start" style="text-align: left; box-shadow: none;">
                    <h6 class="card-title">peserta didik rayon {{ $rayon }} </h6>
                    {{-- jumlah peserta didik --}}
                    <i class="bi bi-person" style="font-size: 30px;"></i>
                    <p style="font-size: 20px; margin: -35px 0 0 50px;">
                        {{ $todayLateCount }}
                    </p>
                </div>
            </div>
            <div class="card" style="width: 450px; margin: 20px 0 0 0; padding: 5px; background-color: white;">
                <div class="card-body justify-content-end" style="text-align: left; box-shadow: none;">
                    <h6 class="card-title">Keterlambatan {{ $rayon }} hari ini</h6>
                    {{-- jumlah peserta didik --}}
                    <i class="bi bi-person" style="font-size: 30px;"></i>
                    <p style="font-size: 20px; margin: -35px 0 0 50px;">
                    {{ $lates }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
