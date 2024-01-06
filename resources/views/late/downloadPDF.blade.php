<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan</title>
    <style>
        body {
            font-size: 30px !important;
            margin: 20px 80px 0 80px;
            font-family: Arial, sans-serif;
        }

        .container {
            font-size: 10px;
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 45px;
            line-height: 4px;
        }

        .content {
            text-align: justify;
        }

        .footer {
            margin-top: 20px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .bottom {
            display: flex;
            justify-content: space-between;
        }

        .top-left,
        .top-right,
        .bottom-left,
        .bottom-right {
            width: 45%;
            /* Adjust the width as needed */
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>SURAT PERNYATAAN</h3>
            <h3>TIDAK AKAN DATANG TERLAMBAT KESEKOLAH</h3>
        </div>

        <div class="content">
            <p style="line-height: 18px;">Yang bertanda tangan di bawah ini:</p>
            <div class="data" style="line-height: 20px; margin-bottom: 35px;">
                <p>NIS : {{ $lates['nis'] }}</p>
                <p>Nama: {{ $lates['name'] }}</p>
                <p>Rombel: {{ $lates['rombel']['rombel'] }}</p>
                <p>Rayon: {{ $lates['rayon']['rayon'] }}</p>
            </div>

            <p style="line-height: 27px;">Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib
                sekolah, yaitu terlambat datang ke sekolah sebanyak <strong>3 Kali</strong> yang mana hal tersebut
                termasuk kedalam pelanggaran kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi.
                Apabila saya terlambat datang ke sekolah lagi saya siap diberikan sanksi yang sesuai dengan peraturan
                sekolah.</p>

            <p style="margin-top: 30px;">Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>
        </div>

        <!-- <div class="footer" style="margin-top: 40px;"> -->
        <div class="top" style="margin-top: 60px; margin-left: -40px;">
            <div class="top-left">
                <p style="margin-bottom: 80px;">Peserta Didik,</p>
                <p>( {{ $lates['name'] }} )</p>
            </div>

            <div class="top-right">
                <!-- @php
                    date_default_timezone_set("Asia/Jakarta");
                    $y = date('Y');
                    $m = date('F');
                    $d = date('d');
                @endphp -->
                <p style="margin-top: -10px;">Bogor, {{ $d }} {{ $m }} {{ $y }} </p>
                <p style="margin-bottom: 80px;">Orang Tua/Wali Peserta Didik,</p>
                <p>( ............................. )</p>
            </div>
        </div>

        <div class="bottom" style="margin-top: 40px; margin-bottom: 60px; margin-left: -40px;">
            <div class="bottom-left">
                <p style="margin-bottom: 80px;">Pembimbing Siswa,</p>
                <p>( PS Tajur 5 )</p>
            </div>

            <div class="bottom-right" style="margin-bottom: 100px;">
                <p style="margin-bottom: 80px;">Kesiswaan,</p>
                <p>( ............................. )</p>
            </div>
        </div>

        <!-- </div> -->
    </div>
</body>

</html>