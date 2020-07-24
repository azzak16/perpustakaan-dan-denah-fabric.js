<!DOCTYPE html>
<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="">
  <title>Laporan Data Buku</title>
</head>

<body>
  <h1 class="center">LAPORAN DATA BUKU</h1>
  <table>
    <thead>
      <tr>
        <th>NO.</th>
        <th>KODE BUKU</th>
        <th>JUDUL BUKU</th>
        <th>KATEGORI</th>
        <th>JUMLAH</th>
        <th>PENERBIT</th>
        <th>PENULIS</th>
        <th>TAHUN TERBIT</th>
        <th>LOKASI</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($bukus as $buku)

      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$buku->kode_buku}}</td>
        <td>{{$buku->judul_buku}}</td>
        <td>{{$buku->kategori->kategori}}</td>
        <td>{{$buku->jumlah}}</td>
        <td>{{$buku->penerbit}}</td>
        <td>{{$buku->penulis}}</td>
        <td>{{$buku->tahun_terbit}}</td>
        <td>{{$buku->rak->rak}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
