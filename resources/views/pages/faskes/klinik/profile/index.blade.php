@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://coreui.io/demos/bootstrap/4.3/default-v3/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css"
        rel="stylesheet"> --}}
    <style type="text/css">
        #map {
            height: 400px;
        }
    </style>
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="container-xl px-4 mt-4">
                <!-- Account page navigation-->
                <nav class="nav nav-borders">
                    <a class="nav-link active ms-0" href="">Profile</a>
                </nav>
                <hr class="mt-0 mb-4" />
                <form action="{{ route('faskes.profile.update', Crypt::encrypt($faskes->id)) }}"enctype="multipart/form-data"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Detail Faskes</div>
                                <div class="card-body">
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Kode Faskes</label>
                                            <input
                                                class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text" value="{{ $faskes->kode_faskes }}"
                                                name="nama_lengkap" readonly />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Nama Faskes</label>
                                            <input
                                                class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text" value="{{ $faskes->name }}"
                                                name="nama_lengkap" readonly />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Jenis</label>
                                            <input
                                                class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text"
                                                value="{{ isset($faskes->detail_faskes->detail_jenis) ? $faskes->detail_faskes->detail_jenis->nama_jenis : '-' }}"
                                                name="jenis" readonly />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Layanan</label>
                                            <input
                                                class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text"
                                                value="{{ isset($faskes->detail_faskes->detail_layanan) ? $faskes->detail_faskes->detail_layanan->nama_pelayanan : '-' }}"
                                                name="nama_lengkap" readonly />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="inputFirstName">PJ Faskes</label>
                                            <input
                                                class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text"
                                                value="{{ $faskes->detail_faskes->nama_pimpinan }}" name="nama_lengkap"
                                                readonly />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="inputFirstName">No Ijin Faskes</label>
                                            <input
                                                class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text"
                                                value="{{ $faskes->detail_faskes->no_ijin }}" name="nama_lengkap"
                                                readonly />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="inputFirstName">Tanggal Berakhir Ijin</label>
                                            <input
                                                class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text"
                                                value="{{ \Carbon\Carbon::parse($faskes->detail_faskes->ijin_berakhir)->translatedFormat('d F Y') }}"
                                                name="nama_lengkap" readonly />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-">
                                            <label class="small mb-1" for="inputFirstName">Alamat Faskes</label>
                                            <textarea class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror" id="inputFirstName" type="text"
                                                name="nama_lengkap" readonly wrap="hard" style="resize: none;" rows="3" cols="20">{{ $faskes->detail_faskes->alamat_faskes }}</textarea>
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="inputFirstName">Kelurahan</label>
                                            <input
                                                class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text"
                                                value="{{ $faskes->detail_faskes->kelurahan }}" name="nama_lengkap"
                                                readonly />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="inputFirstName">Kecamatan</label>
                                            <input
                                                class="form-control-plaintext @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text"
                                                value="{{ $faskes->detail_faskes->kecamatan }}" name="nama_lengkap"
                                                readonly />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="inputFirstName" style="color: red;">* Apabila
                                                ingin mengubah data
                                                faskes melalui aplikasi <a
                                                    href="https://dinkes.semarangkota.go.id/siklinik"
                                                    class="text-decoration-none" target="_blank">SIKLINIK</a></label>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Detail Akun</div>
                                <div class="card-body">
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="inputFirstName">Nama Faskes</label>
                                            <input class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                id="inputFirstName" type="text" value="{{ $faskes->name }}"
                                                name="nama_lengkap" readonly disabled />
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Form Group (email address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="username">Username</label>
                                        <input class="form-control @error('username') is-invalid @enderror"
                                            id="username" type="username" value="{{ $faskes->username }}"
                                            name="username" />
                                        @error('username')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                        <input class="form-control @error('email') is-invalid @enderror"
                                            id="inputEmailAddress" type="email" placeholder="Enter your email address"
                                            value="{{ $faskes->email }}" name="email" readonly disabled />
                                        @error('email')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputBirthday">Role</label>
                                            <input class="form-control" id="inputBirthday" type="text"
                                                value="{{ $faskes->role }}" readonly disabled />
                                        </div>
                                    </div>
                                    <!-- Save changes button-->

                                </div>
                            </div>
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">

                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img class="img-account-profile rounded-circle mb-2"
                                        src="{{ url('/storage/' . $faskes->foto_profil) }}"
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/user.png') }}'"
                                        alt="Profil Image" width="150px" height="150px" />
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 3 MB</div>
                                    @error('imageprofile')
                                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                    @enderror
                                    <!-- Profile picture upload button-->

                                    <div class="card mb-4 mb-xl-0 mt-3">
                                        <input class="btn btn-primary" type="file" name="imageprofile"
                                            accept="image/png, image/jpeg" />
                                    </div>

                                </div>
                            </div>
                            <div class="card mb-4 mb-xl-0 mt-3">
                                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                            </div>
                            <div class="card mb-4 mb-xl-0 mt-3">
                                <a class="btn btn-danger" href="{{ route('password.request') }}">Ubah
                                    Password</a>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-3">
                            <div class="card mb-4">
                                <div class="card-header">Lokasi Faskes</div>
                                <div class="card-body">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('addon-scripts')
    <script type="text/javascript">
        function initializeMap() {
            const locations = {!! json_encode($faskes_lokasi, true) !!}
            const center = {!! json_encode($center, true) !!}

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 18,
                center: center,
                draggable: false,
            });
            var infowindow = new google.maps.InfoWindow();
            var bounds = new google.maps.LatLngBounds();
            for (var location of locations) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(location.lat, location.lng),
                    map: map,
                });
                bounds.extend(marker.position);
                google.maps.event.addListener(marker, 'click', (function(marker, location) {
                    return function() {
                        infowindow.setContent("<span style='color:black'><b>" + location.nama + "</b><br>" +
                            location.alamat +
                            "<br><br>" +
                            location.lat +
                            " & " + location
                            .lng + "</span>");
                        infowindow.open(map, marker);
                    }
                })(marker, location));

            }
        }
    </script>
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ config('app.key_gmaps') }}&callback=initializeMap"></script>
@endpush
