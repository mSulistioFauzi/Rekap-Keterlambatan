<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
            text-align: justify;
        }

        div {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .content {
            margin-bottom: 20px;
        }

        .signature {
            margin-top: 30px;
            text-align: center;
            font-style: italic;
        }

        .signature p {
            margin-top: 20px;
            font-weight: bold;
            font-size: 1.2em;
        }

    </style>
</head>

<body>
    <div>
        <h2>SURAT PERNYATAAN TIDAK AKAN DATANG TERLAMBAT KE SEKOLAH</h2>

        <div class="content">
            <p>Yang bertanda tangan di bawah ini:</p>
            <p>NIS: {{ $lates->students->nis}}</p>
            <p>Nama: {{ $lates->students->name }}</p>
            <p>Rombel: {{ $lates->students->rombels->rombel }}</p>
            <p>Rayon: {{ $lates->students->rayons->rayon }}</p>
            <p>Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke sekolah sebanyak {{ $jumlahKeterlambatan }} kali yang mana hal tersebut termasuk ke dalam pelanggaran kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi, saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.</p>
            <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>
            <p>{{ $lates->created_at ? $lates->created_at->format('d F Y') : 'Tanggal tidak tersedia' }} Orang Tua/Wali Peserta Didik,</p>
        </div>

        <div class="signature">
            <p>__________________________</p>
            <p>Peserta Didik, {{ $lates->students->name }}</p>
            <p>___________________________</p>
            <p>Pembimbing Siswa, Kesiswaan, {{ $lates->students->rayons->rayon }}</p>
        </div>
    </div>
</body>

</html>
