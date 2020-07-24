<!DOCTYPE html>
<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="">
  <title>Laporan Data Transaksi</title>
</head>

<body>
  @if (request('status') == 'book')
  <h1 class="center">LAPORAN DATA TRANSAKSI BUKU DIBOOKING</h1>
  @elseif (request('status') == 'pinjam')
  <h1 class="center">LAPORAN DATA TRANSAKSI BUKU DIPINJAM</h1>
  @elseif (request('status') == 'kembali')
  <h1 class="center">LAPORAN DATA TRANSAKSI BUKU DIKEMBALIKAN</h1>
  @else
  <h1 class="center">LAPORAN DATA TRANSAKSI</h1>
  @endif
  <table>
    <thead>
      @if (request('status') == 'book')
      <tr>
        <th>NO.</th>
        <th>KODE TRANSAKSI</th>
        <th>JUDUL BUKU</th>
        <th>ANGGOTA PEMINJAM</th>
        <th>TANGGAL BOOKING</th>
        <th>JAM BOOKING</th>
        <th>STATUS</th>
      </tr>
      @else
      <tr>
        <th>NO.</th>
        <th>KODE TRANSAKSI</th>
        <th>JUDUL BUKU</th>
        <th>PEGAWAI BERTUGAS</th>
        <th>ANGGOTA PEMINJAM</th>
        <th>TANGGAL BOOKING</th>
        <th>JAM BOOKING</th>
        <th>TANGGAL PINJAM</th>
        <th>BATAS KEMBALI</th>
        <th>TANGGAL DIKEMBALIKAN</th>
        <th>STATUS</th>
        <th>DENDA</th>
      </tr>
      @endif
    </thead>
    <tbody>
      @foreach ($transaksis as $data)
      @if (request('status') == 'book')
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$data->kode_transaksi}}</td>
        <td>{{$data->buku->judul_buku}}</td>
        <td>{{$data->anggota->nama}}</td>
        <td>{{$data->tgl_book}}</td>
        <td>{{$data->jam_book}}</td>
        <td>{{$data->status}}</td>
      </tr>
      @else
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$data->kode_transaksi}}</td>
        <td>{{$data->buku->judul_buku}}</td>
        <td>{{$data->pegawai->nama}}</td>
        <td>{{$data->anggota->nama}}</td>
        <td>{{$data->tgl_book}}</td>
        <td>{{$data->jam_book}}</td>
        <td>{{$data->tgl_pinjam}}</td>
        <td>{{$data->tgl_kembali}}</td>
        <td>{{$data->kembali_bnr}}</td>
        <td>{{$data->status}}</td>
        <td>{{$data->denda}}</td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
</body>

</html>
