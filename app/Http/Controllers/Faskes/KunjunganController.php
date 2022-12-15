<?php

namespace App\Http\Controllers\Faskes;

use Carbon\Carbon;
use App\Models\Nakes;
use App\Models\Pasien;
use App\Helpers\Helpers;
use App\Models\Faskes\Poli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KunjunganController extends Controller
{

    public function caripasien(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->namaPasien) && !empty($request->noCM) && !empty($request->nik))
                $pasien = Pasien::with(['detail_provinsi', 'detail_kotakab', 'detail_kecamatan', 'detail_kelurahan', 'history_last'])
                    ->where('kode_faskes', '=', Auth::user()->kode_faskes)
                    ->where('nama_pasien', 'LIKE', '%' . $request->namaPasien . '%')
                    ->orWhere('no_cm', '=', $request->noCM)
                    ->orWhere('nik', '=', $request->nik)
                    ->get();
            else if (!empty($request->namaPasien)) {
                $pasien = Pasien::with(['detail_provinsi', 'detail_kotakab', 'detail_kecamatan', 'detail_kelurahan', 'history_last'])
                    ->where('kode_faskes', '=', Auth::user()->kode_faskes)
                    ->where('nama_pasien', 'LIKE', '%' . $request->namaPasien . '%')
                    ->get();
            } else if (!empty($request->noCM)) {
                $pasien = Pasien::with(['detail_provinsi', 'detail_kotakab', 'detail_kecamatan', 'detail_kelurahan', 'history_last'])
                    ->where('kode_faskes', '=', Auth::user()->kode_faskes)
                    ->where('no_cm', '=', $request->noCM)
                    ->get();
            } else if (!empty($request->nik)) {
                $pasien = Pasien::with(['detail_provinsi', 'detail_kotakab', 'detail_kecamatan', 'detail_kelurahan', 'history_last'])
                    ->where('kode_faskes', '=', Auth::user()->kode_faskes)
                    ->where('nik', '=', $request->nik)
                    ->get();
            }
            return DataTables::of($pasien)
                ->addColumn('usia', function ($row) {
                    $usia = Helpers::getAge($row->tgl_lahir);
                    return $usia;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<table><tbody><tr class="text-center">';
                    $btn = $btn . '<td class="text-center">
                            <button type="button" class="btn btn bg-success-gradient btn-sm me-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal' . $row->no_cm . '">Catat Kunjungan</button>
                            </td>';
                    $btn = $btn . '</tr></tbody></table>';

                    $btn =  $btn . '
                    <div class="modal fade" id="exampleModal' . $row->no_cm . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><span class="badge rounded-pill text-bg-success">Pasien ' . $row->nama_pasien . '</span></h5>
                          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="' . route('faskes.kunjungan.store') . '" method="POST">
                                ' . csrf_field() . '' . method_field('POST') . '
                                <div class="col-md-12">
                                <div class="container">
                                <div class="row">
                                <div class="col">
                                <table>
                                <tr>
                                <td>No CM</td>
                                <td width="20px">:</td>
                                <td><input name="no_cm" class="form-control-plaintext" value="' . $row->no_cm . '" readonly/></td>
                                </tr>
                                <tr>
                                <td>NIK</td>
                                <td width="20px">:</td>
                                <td><input name="nik" class="form-control-plaintext" value="' . $row->nik . '" readonly/></td>
                                </tr>
                                <tr>
                                <td>No IHS Pasien</td>
                                <td width="20px">:</td>
                                <td><input name="no_ihs" class="form-control-plaintext" value="' . $row->no_ihs . '" readonly/></td>
                                </tr>
                                <tr>
                                <td>Asuransi</td>
                                <td width="20px">:</td>
                                <td><input name="asuransi" class="form-control-plaintext" value="' . $row->asuransi  . '" readonly/></td>
                                </tr>
                                </table>
                                 </div>
                                 <div class="col">
                                 <table>';
                    $btn = $btn . '<tr>
                             <td>Kode Kunjungan</td>
                             <td width="20px">:</td>
                             <td>';
                    $btn = $btn . '<input name="kode_kunjungan" class="form-control-plaintext" value=' . Helpers::IDKunjungan(Auth::user()->kode_faskes) . ' readonly/>';
                    $btn = $btn . '</td><tr>
                             <td>Status Kunjungan</td>
                             <td width="20px">:</td>
                             <td>';
                    if (empty($row->history_last)) {
                        $btn = $btn . '<input name="status_kunjungan" class="form-control-plaintext" value="Baru" readonly/>';
                    } else if (!empty($row->history_last)) {
                        $created = new Carbon($row->history_last->created_at);
                        $now = Carbon::now();
                        if ($created->diff($now)->days > 365) {
                            $btn = $btn . '<input name="status_kunjungan" class="form-control-plaintext" value="Baru" readonly/>';
                        } else {
                            $btn = $btn . '<input name="status_kunjungan" class="form-control-plaintext" value="Lama" readonly/>';
                        }
                    } else {
                        $btn = $btn . '<input name="status_kunjungan" class="form-control-plaintext" value="Baru" readonly/>';
                    }

                    $btn = $btn . '</td>
                             </tr>
                             <tr>
                             <td>Kunjungan Terakhir</td>
                             <td width="20px">:</td>
                             <td>';
                    if (!empty($row->history_last)) {
                        $btn =  $btn . Carbon::parse($row->history_last->created_at)->translatedFormat('l, d F Y H:i:s');
                    } else {
                        $btn =  $btn . '-';
                    }
                    $btn =  $btn . '</td>
                             </tr>
                             <tr>
                                <td>No Asuransi</td>
                                <td width="20px">:</td>
                                <td><input name="nomor_asuransi" class="form-control-plaintext" value="' . $row->nomor_asuransi  . '" readonly/></td>
                                </tr>
                             </table>
                                 </div>
                                 </div>

                                    <hr>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-2">Tanggal Kunjungan</label>
                                        <div class="col-sm-6">
                                            <input type="date" name="tgl_kunjungan" value="' . Carbon::now()->format('Y-m-d') . '" class="form-control">
                                         </div>
                                         <div class="col-lg-4">
      <div data-coreui-date="2023/03/15" data-coreui-locale="en-US" data-coreui-toggle="date-picker"></div>
    </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                    <label for="poli" class="col-sm-2">Poli</label>
                                    <div class="col-sm-6">
                                       <select class="form-select" name="poli">
                                       <option value="" class=""> - Pilih -</option>';
                    $data = Poli::
                        // with('organization')->whereHas('organization', function ($query) {
                        //     $query->join('users', 'users.id_puskesmas', '=', 'organizations.id');
                        //     $query->where('users.id_puskesmas', Auth::user()->id_puskesmas);
                        // })
                        where('status', '=', 'active')
                        // ->whereNotNull('locations.id_location_respons')
                        ->get();
                    foreach ($data as $d) {
                        $btn .= '<option value="' . $d->kode_poli . '">' . $d->nama_poli . '</option>';
                    }
                    $btn = $btn . '</select>
                                    </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                    <label for="dokter" class="col-sm-2">Dokter</label>
                                    <div class="col-sm-6">
                                       <select class="form-select" name="dokter">
                                       <option value="" class=""> - Pilih -</option>
                                       ';
                    $data = Nakes::with(['detail_jabatan'])->where('status', '=', 'active')->whereNot('jabatan_nakes', '=', 4)->get();
                    foreach ($data as $d) {
                        $btn .= '<option value="' . $d->kode_nakes . '">' . $d->nama_nakes . '</option>';
                    }
                    $btn = $btn . '</select>
                                    </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                    <label class="col-sm-2">Status Pasien</label>
                                    <div class="col-sm-6">
                                       <select name="status_pasien" class="form-select">
                                       <option value="" class=""> - Pilih -</option>
                                       <option value="arrived" class="" selected>Sudah Datang</option>
                                       <option value="cancelled" class="" disabled>Dibatalkan</option>
                                       </select>
                                     </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-2">Cara Bayar</label>
                                    <div class="col-sm-6">
                                       <select name="cara_bayar" class="form-select">
                                       <option value="" class=""> - Pilih -</option>
                                       <option value="BPJS" class="">BPJS</option>
                                       <option value="Bayar" class="">Bayar</option>
                                       </select>
                                     </div>
                                </div>

                                </div>
                                <div class="d-flex justify-content-center text-center mt-4 mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                                    ';

                    return $btn;
                })
                ->editColumn('tmp_lahir', function ($data) {
                    $formatedDate = $data->tmp_lahir . ', ' . Carbon::parse($data->tgl_lahir)->translatedformat('d F Y');
                    return $formatedDate;
                })
                ->editColumn('alamat', function ($data) {
                    $loc = $data->alamat . ' ' . (strtolower($data->detail_kotakab->kota . ', Kecamatan ' . $data->detail_kecamatan->kecamatan . ', Kelurahan ' . $data->detail_kelurahan->kelurahan . ' Provinsi ' . $data->detail_provinsi->provinsi));
                    return ucwords($loc);
                })
                ->rawColumns(['action', 'usia'])
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.faskes.klinik.kunjungan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'no_cm' => 'required',
            // 'no_ihs' => 'required',
            'nik' => 'required',
            'tgl_kunjungan' => 'required',
            'poli' => 'required',
            'dokter' => 'required',
            'status_pasien' => 'required',
            'cara_bayar' => 'required',
        ], [
            'dokter.required' => 'Dokter wajib dipilih',
            'no_cm.required' => 'No CM tidak boleh kosong',
            // 'no_ihs.required' => 'No IHS tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'tgl_kunjungan.required' => 'Tanggal Kunjungan tidak boleh kosong',
            'poli.required' => 'Poli wajib dipilih',
            'status_pasien.required' => 'Status Pasien wajib dipilih',
            'cara_bayar.required' => 'Cara Bayar wajib dipilih',
        ]);
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            // $data = Pasien::with(['organization'])->where('pasiens.no_cm', '=', $request->no_cm)->firstOrFail();
            // $nakes = Nakes::findOrFail($request->dokter);
            // $poli = Location::findOrFail($request->poli);
            // $json = array(
            //     "resourceType" => "Encounter",
            //     "status" => $request->status_pasien,
            //     "class" => array(
            //         "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
            //         "code" => "AMB",
            //         "display" => "ambulatory",
            //     ),
            //     "subject" => array(
            //         "reference" => "Patient/" . $data->no_ihs,
            //         "display" => $data->nama_pasien,
            //     ),
            //     "participant" => [
            //         array(
            //             "type" => [
            //                 array(
            //                     "coding" => [
            //                         array(
            //                             "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
            //                             "code" => "ATND",
            //                             "display" => "attender"
            //                         )
            //                     ]
            //                 )
            //             ],
            //             "individual" => array(
            //                 "reference" => "Practitioner/" . $nakes->no_ihs_nakes,
            //                 "display" => $nakes->name,
            //             )
            //         )
            //     ],
            //     "period" => array(
            //         "start" => Carbon::now()->format('Y-m-d\TH:i:sp'),
            //         "end" => Carbon::now()->addMinutes(5)->format('Y-m-d\TH:i:sp'),
            //     ),
            //     "location" => [
            //         array(
            //             "location" => array(
            //                 "reference" => "Location/" . $poli->id_location_respons,
            //                 "display" => $poli->name_location . ' ' . $poli->organization->nama_organisasi
            //             )
            //         )
            //     ],
            //     "statusHistory" => [
            //         array(
            //             "status" => $request->status_pasien,
            //             "period" => array(
            //                 "start" => Carbon::now()->format('Y-m-d\TH:i:sp'),
            //                 "end" => Carbon::now()->addMinutes(5)->format('Y-m-d\TH:i:sp'),
            //             ),
            //         )
            //     ],
            //     "serviceProvider" => array(
            //         "reference" => "Organization/" . $data->organization->id_ihs_org
            //     ),
            //     "identifier" => array(
            //         array(

            //             "system" => "http://sys-ids.kemkes.go.id/encounter/" . $data->organization->id_ihs_org,
            //             "value" => Helpers::IDvisitation()
            //         )
            //     ),
            // );
            // $send = json_encode($json, JSON_UNESCAPED_SLASHES);
            try {
                // $response = Helpers::GetIdEncounter($send);
                $data = [
                    // 'id_encounter' => $response->id,
                    'kode_faskes' => Auth::user()->kode_faskes,
                    'id_kunjungan' => $request->kode_kunjungan,
                    'no_cm' => $request->no_cm,
                    'no_ihs' => $request->no_ihs,
                    'dokter' => $request->dokter,
                    'tgl_kunjungan' => Carbon::parse($request->tgl_kunjungan)->format('Y-m-d'),
                    'poli' => $request->poli,
                    'status_pasien' => $request->status_pasien,
                    'status_kunjungan' => $request->status_kunjungan,
                    'start' => Carbon::now()->format('Y-m-d H:i:s'),
                    'cara_bayar' => $request->cara_bayar,
                ];
                // dd($data);
                if (Kunjungan::create($data)) {
                    return redirect()->route('faskes.catat.show', Crypt::encrypt($request->kode_kunjungan))->with('success', 'Data kunjungan disimpan');
                } else {
                    return redirect()->back()->with('errors', 'Data kunjungan disimpan');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('toast_error', "Tidak dapat mengirim data ke Kemenkes\n\n" . $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function list()
    {
        return view('pages.faskes.klinik.kunjungan.list');
    }
    public function datalist(Request $request)
    {
        $pasien = Kunjungan::with(['detail_pasien', 'detail_poli', 'detail_pemeriksaan', 'detail_faskes'])
            ->where('tgl_kunjungan', Carbon::parse($request->tgl)->format('Y-m-d'))
            ->where('kunjungans.status_pasien', array('arrived', 'planned'))
            ->get();
        return DataTables::of($pasien)
            ->addIndexColumn()
            ->addColumn('usia', function ($row) {
                $usia = Helpers::getAge($row->detail_pasien->tgl_lahir);
                return $usia;
            })
            ->addColumn('action', function ($row) {
                $btn = '<table><tbody><tr class="text-center">';
                $btn = $btn . '<td class="text-center">
            <form action="' . route('faskes.catat.show', Crypt::encrypt($row->id_kunjungan)) . '" method="post" class="d-inline" title="Lakukan pemeriksaan Pasien '  . $row->detail_pasien->nama_pasien . '">
            ' . method_field('GET') . '
            ' . csrf_field() . '
            <button class="btn bg-success-gradient btn-sm me-2">Pemeriksaan
        </button>
            </form>
                    </td>';
                $btn = $btn . '<td class="text-center">
            <form action="' . route('faskes.kunjungan.destroy', Crypt::encrypt($row->id_kunjungan)) . '" method="post" class="d-inline" title="Batalkan kunjungan Pasien '  . $row->detail_pasien->nama_pasien . '">
            ' . method_field('DELETE') . '
            ' . csrf_field() . '
            <button class="btn bg-danger-gradient btn-sm me-2">Batalkan
        </button>
            </form>
                    </td></tr>';
                $btn = $btn . '</tbody></table>';
                return $btn;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kunjungan::where('id_kunjungan', '=', Crypt::decrypt($id))->firstOrFail();
        $data->update(['status_pasien' => 'cancelled']);
        if ($data->delete()) {
            return redirect()->back()->with('success', 'Kunjungan berhasil dibatalkan');
        } else {
            return redirect()->back()->with('errors', 'Gagal membatalkan kunjungan');
        }
    }
}