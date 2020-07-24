<!DOCTYPE html>
<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style type="text/css">
    table {
      border-spacing: 0;
      width: 100%;
    }

    th {
      background: #404853;
      background: linear-gradient(#687587, #404853);
      border-left: 1px solid rgba(0, 0, 0, 0.2);
      border-right: 1px solid rgba(255, 255, 255, 0.1);
      color: #fff;
      padding: 8px;
      text-align: center;
      text-transform: uppercase;
    }

    th:first-child {
      border-top-left-radius: 4px;
      border-left: 0;
    }

    th:last-child {
      border-top-right-radius: 4px;
      border-right: 0;
    }

    td {
      border-right: 1px solid #c6c9cc;
      border-bottom: 1px solid #c6c9cc;
      padding: 8px;
    }

    td:first-child {
      border-left: 1px solid #c6c9cc;
    }

    tr:first-child td {
      border-top: 0;
    }

    tr:nth-child(even) td {
      background: #e8eae9;
    }

    tr:last-child td:first-child {
      border-bottom-left-radius: 4px;
    }

    tr:last-child td:last-child {
      border-bottom-right-radius: 4px;
    }

    img {
      width: 40px;
      height: 40px;
      border-radius: 100%;
    }

    .center {
      text-align: center;
    }

    .badge {
      display: inline-block;
      padding: 0.25em 0.4em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: 0.25rem;
    }

    .badge-warning {
      color: #212529;
      background-color: #ffaf00;
    }

    .badge-warning[href]:hover,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:hover,
    .badge-warning[href]:focus,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:focus {
      color: #212529;
      text-decoration: none;
      background-color: #cc8c00;
    }

    .badge-success,
    .preview-list .preview-item .preview-thumbnail .badge.badge-online {
      color: #fff;
      background-color: #00ce68;
    }

    .badge-success[href]:hover,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:hover,
    .badge-success[href]:focus,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:focus {
      color: #fff;
      text-decoration: none;
      background-color: #009b4e;
    }

    .badge-info,
    .preview-list .preview-item .preview-thumbnail .badge.badge-online {
      color: #212529;
      background-color: #4287f5;
    }

    .badge-info[href]:hover,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:hover,
    .badge-info[href]:focus,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:focus {
      color: #212529;
      text-decoration: none;
      background-color: #009b4e;
    }
  </style>
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
        <th>TANGGAL & JAM BOOKING</th>
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
        <td><label class="badge badge-info">BOOK</label></td>
      </tr>
      @else
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$data->kode_transaksi}}</td>
        <td>{{$data->buku->judul_buku}}</td>
        <td>{{$data->pegawai->nama}}</td>
        <td>{{$data->anggota->nama}}</td>
        <td>{{$data->tgl_book}} <br> {{$data->jam_book}}</td>
        <td>{{$data->tgl_pinjam}}</td>
        <td>{{$data->tgl_kembali}}</td>
        <td>{{$data->kembali_bnr}}</td>
        <td>
          @if ($data->status == 'book')
          <label class="badge badge-info">BOOK</label>
          @elseif($data->status == 'pinjam')
          <label class="badge badge-warning">PINJAM</label>
          @else
          <label class="badge badge-success">KEMBALI</label>
          @endif
        </td>
        <td>Rp. {{$data->denda}}</td>
      </tr>
      @endif
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td>#</td>
        <td>TOTAL DENDA</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Rp. {{$transaksis->sum('denda')}}</td>
      </tr>
    </tfoot>
  </table>
</body>

</html>
