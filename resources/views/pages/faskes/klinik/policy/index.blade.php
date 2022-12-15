@extends('layouts.app')
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Policy</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Policy</span></li>
                </ol>
            </nav>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-center">

                        <h1 class="badge bg-primary-gradient ms-2 text-center" style="font-size: 20px"><strong>Syarat &
                                Ketentuan
                                Penggunaan Sistem Informasi
                                Manajamen Elektronik Klinik</strong></h1>
                    </div>
                </div>
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="d-flex justify-content-center">
                                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-152">
                                    <object
                                        data='http://119.2.50.170:9095/sim-klinik/asset/pdf/EULA%20SIM-e%20KLINIK%20FIX.pdf'
                                        type="application/pdf" width="800" height="900">

                                        <iframe
                                            src='http://119.2.50.170:9095/sim-klinik/asset/pdf/EULA%20SIM-e%20KLINIK%20FIX.pdf'
                                            width="800" height="900">
                                            <p>This browser does not support PDF!</p>
                                        </iframe>
                                    </object>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
