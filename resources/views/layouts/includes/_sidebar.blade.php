<div id="sidebar-nav" class="sidebar">
  <div class="sidebar-scroll">
    <nav>
      <ul class="nav">
        <li><a href="/home" class="active"><i class="lnr lnr-home"></i>
            <span>Dashboard</span></a></li>
        @if(Auth::user()->role == 'admin')
        <li>
          <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i>
            <span>Data User</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
          <div id="subPages" class="collapse ">
            <ul class="nav">
              <li><a href="{{route('pegawai.index')}}" class="">Data Pegawai</a></li>
              <li><a href="{{route('anggota.index')}}" class="">Data Anggota</a></li>
            </ul>
          </div>
        </li>
        @endif
        @if(Auth::user()->role == 'ptgs')
        <li><a href="{{route('anggota.index')}}"><i class="lnr lnr-user"></i> <span>Data Anggota</span> </a></li>
        @endif
        <li><a href="{{route('buku.index')}}" class=""><i class="lnr lnr-book"></i> <span>Data Buku</span></a></li>
        @if(Auth::user()->allowsConfig())
        <li><a href="{{route('kategori.index')}}" class=""><i class="lnr lnr-spell-check"></i> <span>Kategori
              Buku</span></a></li>
        <li><a href="{{route('rak.index')}}" class=""><i class="lnr lnr-frame-expand"></i> <span>Rak Buku</span></a>
        </li>
        @endif
        <li>
          <a href="#sub" data-toggle="collapse" class="collapsed"><i class="lnr lnr-layers"></i>
            <span>Data Transaksi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
          <div id="sub" class="collapse ">
            <ul class="nav">
              <li><a href="{{route('transaksi.create')}}" class="">Entry Transaksi</a></li>
              @if(Auth::user()->allowsConfig())
              <li><a href="{{url('/book')}}" class="">Booking Transaksi</a></li>
              <li><a href="{{url('/pinjam')}}" class="">Pinjam Transaksi</a></li>
              <li><a href="{{url('/kembali')}}" class="">Kembali Transaksi</a></li>
              <li><a href="{{url('/batal')}}" class="">Batal Transaksi</a></li>
              @endif
              <li><a href="{{route('transaksi.index')}}" class=""> All Transaksi</a></li>
            </ul>
          </div>
        </li>
        @if(Auth::user()->allowsConfig())
        <li><a href="{{url('/denah')}}"><i class="lnr lnr-move"></i> <span>Custome Denah</span> </a></li>
        <li><a href="{{url('/denda')}}"><i class="lnr lnr-diamond"></i> <span>Denda</span> </a></li>
        <li><a href="{{url('/laporan')}}"><i class="lnr lnr-chart-bars"></i> <span>Laporan</span> </a></li>
        <li><a href="{{route('post.index')}}"><i class="lnr lnr-pencil"></i> <span>Posts</span> </a></li>
        @endif
      </ul>
    </nav>
  </div>
</div>
