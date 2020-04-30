<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembayaran Tagihan Sekolah Siswa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
</head>

<body>

    <center>
        <h4>Laporan Pembayaran Tagihan Sekolah Siswa</h4>
    </center>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col">
                <table width="350">
                    <tr>
                        <td width="57">Jenis Filter</td>
                        <td width="15">:</td>
                        <td>{{ $jenisfilter }}</td>
                    </tr>
                </table>
            </div>
            <div class="col">

            </div>
        </div>

        <div class="row">
            <div class="col">
                <table width="350">
                    <tr>
                        <td width="57">Periode</td>
                        <td width="15">:</td>
                        <td>{{ $periode }}</td>
                    </tr>
                </table>
            </div>
            <div class="col">

            </div>
        </div>
    </div>
    <br>
    <table class='table table-bordered' style="margin-top: 45px;">
        <thead>
            <tr align="center" style="text-align: center !important;">
                <th width="5">No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Petugas</th>
                <th>Jenis Pembayaran</th>
                <th>Tanggal</th>
                <th>Dibayarkan</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            $jumlah_uang = 0;
            @endphp
            @foreach($pembayaran as $p)
            <tr align="center" style="text-align: center;">
                <th width="5">{{ $no++ }}</th>
                <td>{{$p->tagihan->siswa->nama_siswa}}</td>
                <td>{{$p->tagihan->siswa->class->nama_kelas}}</td>
                <td>{{$p->petugas->nama_petugas}}</td>
                <td>{{$p->tagihan->tipetagihan->nama_tagihan}}</td>
                <td>{{$p->created_at}}</td>
                <td class="uang">Rp. {{ number_format($p->nominal,0,'.','.')}}
                    @php
                    $jumlah_uang += $p->nominal;
                    @endphp
                </td>
            </tr>
            @endforeach
            <tr align="center">
                <td colspan="6">Total Uang Diterima</td>
                <td class="uang">Rp. {{ number_format($jumlah_uang,0,'.','.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>