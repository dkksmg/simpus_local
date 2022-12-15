<?php

namespace App\Http\Controllers\Faskes;

use Carbon\Carbon;
use App\Models\Nakes;
use App\Models\Pasien;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Models\MasterProvinsi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pasien::where('kode_faskes', '=', Auth::user()->kode_faskes,)
                ->with(['detail_faskes', 'detail_provinsi', 'detail_kotakab', 'detail_kecamatan', 'detail_kelurahan'])->whereHas('detail_faskes', function ($query) {
                    $query->where('faskes.status', '=', 'active');
                    $query->orWhere('faskes.status', '=', 'inactive');
                })->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<table><tbody><tr class="text-center">';
                    $btn = $btn . '<td class="text-center">
                    <button class="btn btn-warning btn-sm me-2" title="Edit Data ' . $row->name . '" onclick="window.location.href=\'' . route('faskes.nakes.edit', Crypt::encrypt($row->kode_nakes)) . '\'" ><i class="fa-solid fa-pencil"></i></button>

                    </td>';
                    $btn = $btn . '<td class="text-center">
                    <form action="' . route('faskes.nakes.destroy', Crypt::encrypt($row->kode_nakes)) . '" method="post" class="d-inline" title="Hapus Data Nakes '  . $row->name . '">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                    <button class="btn btn-danger btn-sm me-2"><i class="fa-solid fa-trash"></i>
                    </button>
                    </form>
                    </td>';
                    $btn = $btn . '</tr></tbody></table>';
                    return $btn;
                })
                ->addColumn('usia', function ($row) {
                    $usia = Helpers::getAge($row->tgl_lahir);
                    return $usia;
                })
                ->rawColumns(['action', 'usia'])
                ->editColumn('tgl_lahir', function ($data) {
                    $formatedDate = $data->tmp_lahir . ', ' . Carbon::parse($data->tgl_lahir)->translatedformat('d F Y');
                    return $formatedDate;
                })
                ->editColumn('alamat', function ($data) {
                    $loc = $data->alamat . ' ' . ucwords(strtolower($data->detail_kotakab->kota . ', Kecamatan ' . $data->detail_kecamatan->kecamatan . ', Kelurahan ' . $data->detail_kelurahan->kelurahan . ' Provinsi ' . $data->detail_provinsi->provinsi));
                    return $loc;
                })
                ->make(true);
        }
        return view('pages.faskes.klinik.pasien.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $no_cm = Helpers::NoCm(Auth::user()->kode_faskes);
        $provinsi = MasterProvinsi::all()->sortBy('provinsi');
        return view('pages.faskes.klinik.pasien.create', [
            'provinsi' => $provinsi,
            'no_cm' => $no_cm
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = Validator::make(
            $request->all(),
            [
                'no_cm' => 'required|string',
                'nik' => 'required|integer|digits:16',
                'asuransi_pasien' => 'required',
                'no_asuransi' => 'string',
                'nama_pasien' => 'required|string|max:100',
                'nama_kk' => 'required|string|max:100',
                'no_kontak' => 'required|numeric|digits_between:9,13',
                'jenis_kelamin' => 'required',
                'tmp_lahir' => 'required|alpha',
                'tgl_lahir' => 'required|date',
                'provinsi_ktp' => 'required',
                'kotakab_ktp' => 'required',
                'kec_ktp' => 'required',
                'kel_ktp' => 'required',
                'alamat_ktp' => 'required|string|max:255',
            ],
            [
                'no_cm.required' => 'No CM tidak boleh kosong',
                'no_cm.string' => 'No CM wajib berupa string',
                'nik.required' => 'NIK tidak boleh kosong',
                'nik.numeric' => 'NIK wajib berupa angka',
                'nik.digits' => 'NIK berisi maksimum 16 digit',
                'asuransi_pasien.required' => 'Asuransi wajib di pilih',
                'no_asuransi.string' => 'Nomor Asuransi wajib berupa string',
                'nama_pasien.required' => 'Nama Pasien tidak boleh kosong',
                'nama_pasien.string' => 'Nama Pasien harus berupa string',
                'nama_pasien.max' => 'Nama Pasien maksimum berisi 100 karakter',
                'nama_kk.required' => 'Nama Kepala Keluarga tidak boleh kosong',
                'nama_kk.string' => 'Nama Kepala Keluaraga harus berupa string',
                'nama_kk.max' => 'Nama Kepala Keluarga maksimum berisi 100 karakter',
                'no_kontak.required' => 'Nomor kontak tidak boleh kosong',
                'no_kontak.numeric' => 'Nomor kontak wajib berupa angka',
                'no_kontak.digits' => 'Nomor kontak maksimum berisi 13 digit',
                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
                'tmp_lahir.required' => 'Tempat Lahir tidak boleh kosong',
                'tmp_lahir.alpha' => 'Tempat Lahir wajib berupa huruf',
                'tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
                'tgl_lahir.date' => 'Tanggal Lahir merupakan tanggal yang valid',
                'provinsi_ktp.required' => 'Provinsi wajib dipilih',
                'kotakab_ktp.required' => 'Kota/Kab wajib dipilih',
                'kec_ktp.required' => 'Kecamatan wajib dipilih',
                'kel_ktp.required' => 'Kelurahan wajib dipilih',
                'alamat_ktp.required' => 'Alamat tidak boleh kosong',
                'alamat_ktp.string' => 'Alamat harus berupa string',
                'alamat_ktp.max' => 'Alamat maksimum 155 karakter',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $data = [
                'kode_faskes' => Auth::user()->kode_faskes,
                'no_cm' => $request->no_cm,
                'kode_ihs_pasien' => null,
                'nik' => $request->nik,
                'asuransi' => $request->asuransi_pasien,
                'nomor_asuransi' => $request->no_asuransi,
                'nama_pasien' => $request->nama_pasien,
                'nama_kk' => $request->nama_kk,
                'no_hp_telp' => $request->no_kontak,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tmp_lahir' => ucfirst($request->tmp_lahir),
                'tgl_lahir' => Carbon::parse($request->tgl_lahir)->format('Y-m-d'),
                'provinsi' => $request->provinsi_ktp,
                'kota_kab' => $request->kotakab_ktp,
                'kecamatan' => $request->kec_ktp,
                'kelurahan' => $request->kel_ktp,
                'alamat' => $request->alamat_ktp
            ];
            if (Pasien::create($data)) {
                return redirect()->route('faskes.kunjungan')->with('success', 'Data Pasien berhasil tersimpan');
            } else {
                return redirect()->back()->with('danger', 'Data Pasien gagal tersimpan');
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
        //
    }
}