<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        {{-- <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo"> --}}
        {{-- <use xlink:href="{{ url('assets/simpus.svg') }}"></use>
        </svg> --}}
        {{-- <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ url('assets/brand/coreui.svg#signet') }}"></use>
        </svg> --}}
        {{-- <img src="{{ url('assets/simpus_new.png') }}" alt="logo simpus" class="sidebar-brand-full rounded mx-auto d-block"
            width="100" height="46"> --}}
        <span class="sidebar-brand-full">
            <badge class="rounded mx-auto d-block"><strong>SIM E-KLINIK</strong></badge>
        </span>
        <img src="{{ url('assets/img/favicon.png') }}" alt="logo pemkot" class="sidebar-brand-narrow" width="46"
            height="46">
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="nav-icon fa-regular fa-gauge-max"></i> Dashboard</a></li>
        <li class="nav-title">Layanan</li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="javascript:void(0)">
                <i class="nav-icon fa-regular fa-users-medical"></i>
                Pasien</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('faskes.pasien.create') }}">
                        <i class="nav-icon fa-regular fa-circle-info"></i>
                        Pendaftaran Pasien Baru</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('faskes.pasien') }}">
                        <i class="nav-icon fa-regular fa-circle-info"></i>
                        Data Pasien</a></li>
            </ul>
        </li>
        <li class="nav-group {{ Request::segment(2) == 'kunjungan' ? 'show' : '' }}"
            aria-expanded="{{ Request::segment(2) == 'kunjungan' ? 'true' : 'false' }}">
            <a class="nav-link nav-group-toggle" href="javascript:void(0)">
                <i class="nav-icon fa-regular fa-list"></i>
                Kunjungan</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('faskes.kunjungan') }}">
                        <i class="nav-icon fa-regular fa-circle-info"></i>
                        Pendaftaran Kunjungan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('faskes.kunjungan.list') }}">
                        <i class="nav-icon fa-regular fa-circle-info"></i>
                        List Pasien Berkunjung</a></li>
            </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faskes.nakes') }}">
                <i class="nav-icon fa-regular fa-books-medical"></i>
                Catatan Medik</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faskes.nakes') }}">
                <i class="nav-icon fa-regular fa-book-copy"></i>
                Laporan</a></li>
        <li class="nav-title">Master</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faskes.nakes') }}">
                <i class="nav-icon fa-regular fa-user-doctor"></i>
                Nakes</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faskes.obat') }}">
                <i class="nav-icon fa-regular fa-pills"></i>
                Obat</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faskes.tindakan') }}">
                <i class="nav-icon fa-regular fa-books-medical"></i>
                Tindakan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faskes.poli') }}">
                <i class="nav-icon fa-regular fa-hospitals"></i>
                Poli</a></li>
        <li class="nav-title">Policy</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faskes.policy') }}">
                <i class="nav-icon fa-regular fa-scale-balanced"></i>
                S&K Penggunaan</a></li>
        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('obat.index') }}">
                <i class="nav-icon fa-regular fa-pills"></i>
                Obat</a></li>
        <li class="nav-title">Organization</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('ruangan.index') }}">
                <i class="nav-icon fa-regular fa-house-chimney"></i>
                Poli</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('nakes.index') }}">
                <i class="nav-icon fa-regular fa-users"></i>
                Nakes</a></li>
        <li class="nav-title">Pelayanan</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('pendaftaran.index') }}">
                <i class="nav-icon fa-regular fa-list"></i>
                Pendaftaran</a></li>

        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="javascript:void(0)">
                <i class="nav-icon fa-regular fa-bed-pulse"></i>
                Kunjungan</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('kunjungan.index') }}">
                        <i class="nav-icon fa-regular fa-circle-info"></i>
                        Daftar Kunjungan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('list') }}">
                        <i class="nav-icon fa-regular fa-circle-info"></i>
                        Pasien Berkunjung</a></li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="javascript:void(0)">
                <i class="nav-icon fa-regular fa-stethoscope"></i>
                Rekam Medis</a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rekam-medis.index') }}">
                        <i class="nav-icon fa-regular fa-circle-info"></i>
                        Catatan Medik Pasien</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('catatan') }}">
                        <i class="nav-icon fa-regular fa-circle-info"></i>
                        Riwayat Medik Pasien</a></li>
            </ul>
        </li> --}}

        <li class="nav-title">Login Sebagai : <strong>{{ Auth::user()->role }}</strong></li>

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
