<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $record->nama_inovasi }}</title>
    <style>
        .title-laporan {
            text-align: center;
            padding-bottom: 20px;
        }

        .nama-inovasi {
            font-weight: bold;
            color: darkblue;
            padding-bottom: 5px;
        }

        .inovasi {
            margin-bottom: 15px;
        }

        .img-logo {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="img-logo">
        <img src="{{ public_path('img/kotapasuruan-logo.png') }}" alt="Logo" height="85px">
    </div>
    <div class="title-laporan">
        <h3>PROPOSAL INOVASI DAERAH</h3>
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Nama Inovasi
    </div>
    <div class="inovasi">
        {{ $record->nama_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Nomor Register IGA
    </div>
    <div class="inovasi">
        {{ $record->registrasi_iga }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Tahapan Inovasi
    </div>
    <div class="inovasi">
        {{ $record->tahapan_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Inisiator Inovasi
    </div>
    <div class="inovasi">
        {{ $record->inisiator_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Nama Inisiator
    </div>
    <div class="inovasi">
        {{ $record->nama_inisiator }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Jenis Inovasi
    </div>
    <div class="inovasi">
        {{ $record->jenis_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Klasifikasi Inovasi
    </div>
    <div class="inovasi">
        {{ $record->klasifikasi_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Bentuk
    </div>
    <div class="inovasi">
        {{ $record->bentuk_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Asta Cita
    </div>
    <div class="inovasi">
        {{ $record->astacita_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Urusan Inovasi
    </div>
    <div class="inovasi">
        {{ implode(', ', $record->urusan_inovasi) }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Koordinat
    </div>
    <div class="inovasi">
        {{ $record->koordinat_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Waktu Ujicoba
    </div>
    <div class="inovasi">
        {{ $record->waktu_ujicoba_inovasi }}
    </div>
    <!--  -->
     <div class="nama-inovasi">
        Waktu Implementasi
    </div>
    <div class="inovasi">
        {{ $record->waktu_implementasi_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Waktu Pengembangan
    </div>
    <div class="inovasi">
        {{ $record->waktu_pengembangan_inovasi ?? '-' }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Rancang Bangun
    </div>
    <div class="inovasi">
        {!! $record->rancang_bangun_inovasi !!}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Tujuan
    </div>
    <div class="inovasi">
        {{ $record->tujuan_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Manfaat
    </div>
    <div class="inovasi">
        {{ $record->manfaat_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Hasil
    </div>
    <div class="inovasi">
        {{ $record->hasil_inovasi }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Anggaran
    </div>
    <div class="inovasi">
        {{ $record->anggaran_inovasi ? url('storage', $record->anggaran_inovasi) : '-' }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Profil Bisnis
    </div>
    <div class="inovasi">
        {{ $record->profilbisnis_inovasi ? url('storage', $record->profilbisnis_inovasi) : '-' }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        HKI Inovasi
    </div>
    <div class="inovasi">
        {{ $record->hki_inovasi ? url('storage', $record->hki_inovasi) : '-' }}
    </div>
    <!--  -->
    <div class="nama-inovasi">
        Penghargaan
    </div>
    <div class="inovasi">
        {{ $record->penghargaan_inovasi ? url('storage', $record->penghargaan_inovasi) : '-' }}
    </div>
</body>

</html>