<?php

namespace App\Http\Controllers\Faskes;

use Carbon\Carbon;
use App\Helpers\Helpers;
use App\Models\Kunjungan;
use App\Models\Faskes\Poli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kesadaran;
use App\Models\Nakes;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\StatusPulang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;
use Yajra\DataTables\Facades\DataTables;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pasien = Kunjungan::with(['detail_pasien', 'detail_poli'])
        //     ->where('poli', '=', '33742211012PL102')
        //     ->where('status_pasien', '=', 'arrived')
        //     ->where('tgl_kunjungan', Carbon::parse('14-12-2022')->format('Y-m-d'))
        //     ->get();
        // dd($pasien);
        $ruangan = Poli::with('detail_faskes')->whereHas('detail_faskes', function ($query) {
            $query->join('users', 'users.kode_faskes', '=', 'faskes.kode_faskes');
            $query->where('users.kode_faskes', Auth::user()->kode_faskes);
        })->where('polis.status', '=', 'active')->get();
        return view('pages.faskes.klinik.pemeriksaan.index', [
            'ruangan' => $ruangan
        ]);
    }
    public function carikunjungan(Request $request)
    {
        if ($request->ajax()) {
            $pasien = Kunjungan::with(['detail_pasien', 'detail_poli'])
                ->where('poli', '=', $request->poli)
                ->where('status_pasien', '=', 'arrived')
                ->where('tgl_kunjungan', Carbon::parse($request->tgl)->format('Y-m-d'))
                ->get();
            return DataTables::of($pasien)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<table><tbody><tr class="text-center">';
                    $btn = $btn . '<td class="text-center">
                        <button class="btn btn bg-success-gradient btn-sm me-2" onclick="window.location.href=\'' . route('faskes.catat.show', Crypt::encrypt($row->id_kunjungan)) . '\',_blank,location=yes,height=800,width=700,scrollbars=yes,status=yes" >Periksa Pasien</button>
                        </td>';
                    $btn = $btn . '</tr></tbody></table>';

                    return $btn;
                })
                ->addColumn('usia', function ($row) {
                    $usia = Helpers::getAge($row->detail_pasien->tgl_lahir);
                    return $usia;
                })
                ->editColumn('tgl_kunjungan', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d', $data->tgl_kunjungan)->translatedFormat('d F Y') . ' Pukul ' . Carbon::parse($data->created_at)->translatedFormat('H:i:s');
                    return $formatedDate;
                })
                ->rawColumns(['action', 'usia'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (sizeof($request->obat) >= 1) {
            for ($i = 0; $i < sizeof($request->obat); $i++) {
                $obats[] = array(
                    'obat' => $request->obat[$i],
                    'jumlah' => $request->dosis[$i],
                    'dosis' => $request->jumlah[$i],
                );
            }
        }

        $data = [
            'id_kunjungan' => Crypt::decrypt($request->kunjungan),
            'kode_faskes' => Auth::user()->kode_faskes,
            'no_cm' => $request->no_cm,
            'anamnesa' => $request->anamnesa,
            'kesadaran' => $request->kesadaran,
            'bb' => $request->beratBadan,
            'tb' => $request->tinggiBadan,
            'imt' => $request->imt,
            'lingkar_perut' => $request->lingkarPerut,
            'suhu' => $request->suhu,
            'sistolik' => $request->sistole,
            'diastolik' => $request->diastole,
            'respiratory_rate' => $request->respRate,
            'heart_rate' => $request->heartRate,
            'pemeriksaan_fisik' => $request->pemeriksaanFisik,
            'diag1' => $request->diag1,
            'diag2' => $request->diag2 != null ? $request->diag2 : null,
            'diag3' => $request->diag3 != null ? $request->diag3 : null,
            'tindakan' => json_encode($request->tindakan),
            'obat' => json_encode($obats),
            'dokter' => $request->pemeriksa,
            'poli' => $request->poli,
            'status_pasien' => $request->statusPulang,
            'pertemuan' => $request->status_pemeriksaan,
            'edukasi' => $request->edukasi,
            'tgl_kunjungan' => $request->tgl_kunjungan


        ];
        if (Pemeriksaan::create($data)) {
            return redirect()->route('faskes.catat')->with('success', 'Pemeriksaan berhasil tersimpan');
        } else {
            return redirect()->back()->with('errors', 'Pemeriksaan gagal tersimpan');
        }
    }
    public function old()
    {
        $data = Kunjungan::with(['detail_pasien.detail_provinsi', 'detail_pasien.detail_kotakab', 'detail_pasien.detail_kecamatan', 'detail_pasien.detail_kelurahan', 'detail_poli', 'detail_nakes'])
            ->where('id_kunjungan', 'VT33742211012101')
            ->where('status_pasien', '=', 'arrived')
            ->firstOrFail();
        $usia = Helpers::getAge($data->detail_pasien->tgl_lahir);
        $kesadaran = Kesadaran::where('status', '=', 'active')->get();
        $status_pasien = StatusPulang::where('status', '=', 'active')->get();
        $nakes = Nakes::with(['detail_jabatan'])->where('status', '=', 'active')->whereNot('jabatan_nakes', '=', 4)->get();
        return view('pages.faskes.klinik.pemeriksaan.create-old', ['data' => $data, 'usia' => $usia, 'nakes' => $nakes, 'kesadaran' => $kesadaran, 'status' => $status_pasien]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kunjungan::with(['detail_pasien.detail_provinsi', 'detail_pasien.detail_kotakab', 'detail_pasien.detail_kecamatan', 'detail_pasien.detail_kelurahan', 'detail_poli', 'detail_nakes'])
            ->where('id_kunjungan', Crypt::decrypt($id))
            ->where('status_pasien', '=', 'arrived')
            ->firstOrFail();
        $usia = Helpers::getAge($data->detail_pasien->tgl_lahir);
        $kesadaran = Kesadaran::where('status', '=', 'active')->get();
        $status_pasien = StatusPulang::where('status', '=', 'active')->get();
        $nakes = Nakes::with(['detail_jabatan'])->where('status', '=', 'active')->whereNot('jabatan_nakes', '=', 4)->get();
        return view('pages.faskes.klinik.pemeriksaan.create', ['data' => $data, 'usia' => $usia, 'nakes' => $nakes, 'kesadaran' => $kesadaran, 'status' => $status_pasien]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kunjungan::with(['detail_pasien.detail_provinsi', 'detail_pasien.detail_kotakab', 'detail_pasien.detail_kecamatan', 'detail_pasien.detail_kelurahan', 'detail_poli', 'detail_nakes'])
            ->where('id_kunjungan', Crypt::decrypt($id))
            ->where('status_pasien', '=', 'arrived')
            ->firstOrFail();
        $usia = Helpers::getAge($data->detail_pasien->tgl_lahir);
        $kesadaran = Kesadaran::where('status', '=', 'active')->get();
        $status_pasien = StatusPulang::where('status', '=', 'active')->get();
        $nakes = Nakes::with(['detail_jabatan'])->where('status', '=', 'active')->whereNot('jabatan_nakes', '=', 4)->get();
        return view('pages.faskes.klinik.pemeriksaan.create', ['data' => $data, 'usia' => $usia, 'nakes' => $nakes, 'kesadaran' => $kesadaran, 'status' => $status_pasien]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function riwayatPasien()
    {
        return view('pages.faskes.klinik.pemeriksaan.list-riwayat');
    }
    public function listPasienSelesai(Request $request)
    {
        if ($request->ajax()) {

            $pasien = Pemeriksaan::with(['detail_pasien', 'detail_poli', 'detail_kunjungan', 'detail_faskes'])
                ->where('tgl_kunjungan', '=', Carbon::parse($request->tgl)->format('Y-m-d'))
                ->where('kode_faskes', '=', Auth::user()->kode_faskes)
                ->where('status_pasien', array('finished'))
                ->get();
            return DataTables::of($pasien)
                ->addIndexColumn()
                ->addColumn('usia', function ($row) {
                    $usia = Helpers::getAge($row->detail_pasien->tgl_lahir);
                    return $usia;
                })
                ->addColumn('action', function ($row) {
                    if (!empty($row->created_at)) {
                        $created = new Carbon(Carbon::parse($row->created_at)->format('Y-m-d'));
                        $now = Carbon::now()->format('Y-m-d');
                        if ($created->diff($now)->days >= 14) {
                            return '<button class="btn btn-sm me-2" onclick="alert(\'Aksi tidak ada\')">-
                            </button>';
                        } else {
                            $btn = '<table><tbody><tr class="text-center">';
                            $btn = $btn . '<td class="text-center">
            <form action="' . route('faskes.catat.edit', Crypt::encrypt($row->id_kunjungan)) . '" method="post" class="d-inline" title="Edit Pemeriksaan Pasien '  . $row->detail_pasien->nama_pasien . '">
            ' . method_field('GET') . '
            ' . csrf_field() . '
            <button class="btn bg-warning-gradient btn-sm me-2">Edit Pemeriksaan
        </button>
        </form>
        </td></tr>';
                            $btn = $btn . '</tbody></table>';
                            return $btn;
                        }
                    }
                })
                ->editColumn('tgl_kunjungan', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d', $data->tgl_kunjungan)->translatedFormat('d F Y') . ' Pukul ' . Carbon::parse($data->created_at)->translatedFormat('H:i:s');
                    return $formatedDate;
                })
                ->editColumn('detail_pasien.tgl_lahir', function ($data) {
                    $formatedDate = $data->detail_pasien->tmp_lahir . ', ' . Carbon::parse($data->detail_pasien->tgl_lahir)->translatedformat('d F Y');
                    return $formatedDate;
                })
                ->rawColumns(['action', 'usia'])
                ->make(true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}