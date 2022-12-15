<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Faskes;
use App\Helpers\Helpers;
use App\Mail\EmailLogin;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class FaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cekKodeFaskes(Request $request)
    {
        if ($request->ajax()) {
            $kode = User::with(['detail_faskes'])->where('kode_faskes', '=', $request->kode)->firstOrFail();

            return response()->json([
                'kode' => $kode->kode_faskes,
                'nama_klinik' => $kode->detail_faskes->nama_faskes,
                'status' => $kode->detail_faskes->status
            ], 200);
        }
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', '=', 'KLINIK')->with(['detail_faskes'])->whereHas('detail_faskes', function ($query) {
                $query->where('faskes.status', '=', 'active');
                $query->orWhere('faskes.status', '=', 'inactive');
            })->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<table><tbody><tr class="text-center">';
                    $btn = $btn . '<td class="text-center">
                        <form action="' . route('admin.faskes.resend', Crypt::encrypt($row->kode_faskes)) . '" method="post" class="d-inline" title="Resend Data Akun Faskes '  . $row->name . '">
                        ' . method_field('POST') . '
                        ' . csrf_field() . '
                        <button class="btn btn-info btn-sm me-2"><i class="fa-solid fa-repeat"></i>
                    </button>
                        </form>
                        </td>';
                    if ($row->detail_faskes->status == "active") {
                        $btn = $btn . '<td class="text-center">
                        <form action="' . route('admin.faskes.nonaktifkan', Crypt::encrypt($row->kode_faskes)) . '" method="post" class="d-inline" title="Nonaktifkan Data Faskes '  . $row->name . '">
                        ' . method_field('PUT') . '
                        ' . csrf_field() . '
                        <button class="btn btn-dark btn-sm me-2"><i class="fa-solid fa-circle-xmark"></i>
                    </button>
                        </form>
                        </td>';
                    } else {
                        $btn = $btn . '<td class="text-center">
                        <form action="' . route('admin.faskes.aktifkan', Crypt::encrypt($row->kode_faskes)) . '" method="post" class="d-inline" title="Aktifkan Data Faskes '  . $row->name . '">
                        ' . method_field('PUT') . '
                        ' . csrf_field() . '
                        <button class="btn btn-success btn-sm me-2"><i class="fa-solid fa-badge-check"></i>
                    </button>
                        </form>
                        </td>';
                    }
                    $btn = $btn . '<td class="text-center"><a href="' . route('faskes.edit', Crypt::encrypt($row->kode_faskes)) . '" class="btn btn-warning btn-sm me-2" title="Edit Data ' . $row->name . '"><i class="fa-solid fa-pencil"></i></a></td>';
                    $btn = $btn . '<td class="text-center">
                    <form action="' . route('faskes.destroy', Crypt::encrypt($row->kode_faskes)) . '" method="post" class="d-inline" title="Hapus Data Faskes '  . $row->name . '">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                    <button class="btn btn-danger btn-sm me-2"><i class="fa-solid fa-trash"></i>
                    </button>
                    </form>
                    </td>';
                    $btn = $btn . '</tr></tbody></table>';


                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.faskes.index');
    }
    public function ListNonaktif(Request $request)
    {
        if ($request->ajax()) {
            $data = User::withTrashed()->where('role', '=', 'KLINIK')->whereNotNull('deleted_at')->with(['detail_faskes'])->whereHas('detail_faskes', function ($query) {
                $query->where('faskes.status', '=', 'active');
                $query->orWhere('faskes.status', '=', 'inactive');
            })->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<table><tbody><tr class="text-center">';

                    $btn = $btn . '<td class="text-center">
                        <form action="' . route('admin.faskes.restore', Crypt::encrypt($row->kode_faskes)) . '" method="post" class="d-inline" title="Restore Data Faskes '  . $row->name . '">
                        ' . csrf_field() . '
                        ' . method_field('GET') . '
                        <button class="btn btn-info btn-sm me-2"><i class="fa-solid fa-repeat"></i>
                        </button>
                        </form>
                        </td>';

                    $btn = $btn . '</tr></tbody></table>';


                    return $btn;
                })
                ->editColumn('deleted_at', function ($data) {
                    if (!empty($data->deleted_at)) {
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->deleted_at)->Format('d-m-Y H:i:s');
                        return $formatedDate;
                    } else {
                        return '-';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.faskes.list-nonaktif');
    }
    public function NonaktifkanFaskes($id)
    {
        $faskes = Faskes::where('kode_faskes', '=', Crypt::decrypt($id))->firstOrFail();
        if ($faskes->update(['status' => 'inactive'])) {
            return redirect()->route('faskes.index')->with(['success' => 'Faskes berhasil dinonaktifkan!']);
        } else {
            return redirect()->back()->with(['error' => 'Faskes gagal dinonaktifkan!']);
        }
    }
    public function AktifkanFaskes($id)
    {
        $faskes = Faskes::where('kode_faskes', '=', Crypt::decrypt($id))->firstOrFail();
        if ($faskes->update(['status' => 'active'])) {
            return redirect()->route('faskes.index')->with(['success' => 'Faskes berhasil diaktifkan!']);
        } else {
            return redirect()->back()->with(['error' => 'Faskes gagal diaktifkan!']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('pages.admin.faskes.create', compact(['kecamatan']));
    }
    public function cekFaskes(Request $request)
    {
        if ($request->ajax()) {
            $data = null;
            $klinik = json_decode(file_get_contents('http://119.2.50.170:9095/klinik/api/klinik/detailbaru?kode=' . $request->data . '&fun=Login SimKlinik'));
            if ($klinik->status) {
                $data['nama_faskes'] = 'Klinik ' . $klinik->data->nama;
                $data['kode_faskes'] = $klinik->data->kode_klinik;
                $data['email_faskes'] = $klinik->data->email_faskes;
                $data['pj'] = $klinik->data->pj;
                $data['kontak_pj'] = $klinik->data->hp_pj;
                $data['ijin_faskes'] = $klinik->data->sip;
                $data['tgl_berakhir_ijin'] = Carbon::parse($klinik->data->tgl_berakhir_ijin)->format('d-m-Y');
                $data['alamat'] = $klinik->data->alamat;
                $data['nama_kelurahan'] = $klinik->data->nama_kelurahan;
                $data['nama_kecamatan'] = $klinik->data->nama_kecamatan;
                $data['kontak_faskes'] = $klinik->data->telp;
                $data['koordinat'] = $klinik->data->koordinat;
                $data['jadwal'] = $klinik->data->jadwal;
                $data['kode_kel'] = $klinik->data->kode_kelurahan;
                $data['kode_kec'] = $klinik->data->kode_kecamatan;
                $resp = array('status' => TRUE, 'data' => $data);
            } else {
                $resp = array('status' => FALSE, 'data' => null);
            }
            header("Content-Type:application/json");
            return response()->json($resp);
        }
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
                'email_faskes' => 'required|string|email:rfc,dns|max:255|unique:users,email,',
                'role_faskes' => 'required',
                'password' => 'required|confirmed|min:6',
                'nama_faskes' => 'required|min:5|string',
                'pj_faskes' => 'required|min:5|string',
                // 'kontak_faskes' => 'string',
                'alamat_faskes' => 'required|string',
                'kecamatan_faskes' => 'required',
                'kelurahan_faskes' => 'required',
                'kode_faskes' => 'required',
            ],
            [
                'email_faskes.required' => 'Email tidak boleh kosong',
                'email_faskes.unique' => 'Email sudah digunakan',
                'email_faskes.email' => 'Email harus merupakan alamat email yang valid',
                'email_faskes.max' => 'Email maksimal 255 karakter',
                'role_faskes.required' => 'Role wajib dipilih',
                'password.required' => 'Password tidak boleh kosong',
                'password.confirmed' => 'Konfirmasi password tidak sama',
                'password.min' => 'Password minimal 6 karakter',
                'nama_faskes.required' => 'Nama faskes tidak boleh kosong',
                'nama_faskes.min' => 'Nama faskes minimal 5 karakter',
                'pj_faskes.required' => 'PJ faskes tidak boleh kosong',
                'pj_faskes.min' => 'PJ faskes minimal 5 karakter',
                // 'kontak_faskes.numeric' => 'Nomor Fakes harus berupa angka',
                'alamat_faskes.required' => 'Alamat faskes tidak boleh kosong',
                'kecamatan_faskes.required' => 'Kecamatan tidak boleh kosong',
                'kelurahan_faskes.required' => 'Kelurahan tidak boleh kosong',
                'kode_faskes.required' => 'Kode Faskes tidak boleh kosong',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $user = [
                'name' => $request->nama_faskes,
                'email' => $request->email_faskes,
                'role' => $request->role_faskes,
                'password' => bcrypt($request->password),
                'kode_faskes' => $request->kode_faskes,
                'phone_pj' => $request->kontak_pj,
            ];
            $faskes = [
                'kode_faskes' => $request->kode_faskes,
                'nama_faskes' => $request->nama_faskes,
                'phone_faskes' => $request->kontak_faskes,
                'phone_pj' => $request->kontak_pj,
                'alamat_faskes' => $request->alamat_faskes,
                'nama_pimpinan' => $request->pj_faskes,
                'kecamatan' => $request->kecamatan_faskes,
                'kelurahan' => $request->kelurahan_faskes,
                'koordinat' => $request->koordinat_lokasi,
                'ijin_berakhir' => Carbon::parse($request->tgl_berakhir)->format('Y-m-d'),
                'no_ijin' => $request->no_ijin,
            ];
            $data = [
                'nama' => $request->nama_faskes,
                'email' => $request->email_faskes,
                'password' => $request->password,
                'author' => 'Bidang SDK DKK Semarang',
            ];
            try {
                Mail::to($request->email_faskes)->send(new EmailLogin($data));
                if (User::create($user) && Faskes::create($faskes)) {
                    return redirect()->route('faskes.index')->with('success', 'Data Faskes berhasil disimpan');
                } else {
                    return redirect()->back()->with('danger', 'Data Faskes gagal disimpan');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('danger', 'Gagal mengirim email');
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
        $faskes = Faskes::with(['user'])->where('kode_faskes', '=', Crypt::decrypt($id))->firstOrFail();
        return view('pages.admin.faskes.edit', [
            'faskes' => $faskes,
        ]);
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
        $item = Faskes::with(['user'])->where('kode_faskes', '=', Crypt::decrypt($id))->firstOrFail();
        $validateData = Validator::make(
            $request->all(),
            [
                'email_faskes' => 'required|string|email:rfc,dns|max:255|unique:users,email,' . $item->user->id,
                'role_faskes' => 'required',
                'password' => 'confirmed',
                'nama_faskes' => 'required|min:5|string',
                'pj_faskes' => 'required|min:5|string',
                'kontak_faskes' => 'required|string',
                'alamat_faskes' => 'required|string',
                'kecamatan_faskes' => 'required',
                'kelurahan_faskes' => 'required',
                // 'kode_faskes' => 'required',
            ],
            [
                'email_faskes.required' => 'Email tidak boleh kosong',
                'email_faskes.unique' => 'Email sudah digunakan',
                'email_faskes.email' => 'Email harus merupakan alamat email yang valid',
                'email_faskes.max' => 'Email maksimal 255 karakter',
                'role_faskes.required' => 'Role wajib dipilih',
                // 'password.required' => 'Password tidak boleh kosong',
                'password.confirmed' => 'Konfirmasi password tidak sama',
                // 'password.min' => 'Password minimal 6 karakter',
                'nama_faskes.required' => 'Nama faskes tidak boleh kosong',
                'nama_faskes.min' => 'Nama faskes minimal 5 karakter',
                'pj_faskes.required' => 'PJ faskes tidak boleh kosong',
                'pj_faskes.min' => 'PJ faskes minimal 5 karakter',
                'kontak_faskes.required' => 'PJ faskes tidak boleh kosong',
                'alamat_faskes.required' => 'Alamat faskes tidak boleh kosong',
                'kecamatan_faskes.required' => 'Kecamatan tidak boleh kosong',
                'kelurahan_faskes.required' => 'Kelurahan tidak boleh kosong',
                // 'kode_faskes.required' => 'Kode Faskes tidak boleh kosong',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $user = [
                'name' => $request->nama_faskes,
                'email' => $request->email_faskes,
                'role' => $request->role_faskes,
                'password' => $request->password != null ? bcrypt($request->password) : $item->user->password,
                'phone_pj' => $request->kontak_pj,
                // 'kode_faskes' => $request->kode_faskes,
            ];
            $faskes = [
                // 'kode_faskes' => $request->kode_faskes,
                'nama_faskes' => $request->nama_faskes,
                'phone_faskes' => $request->kontak_faskes,
                'phone_pj' => $request->kontak_pj,
                'alamat_faskes' => $request->alamat_faskes,
                'nama_pimpinan' => $request->pj_faskes,
                'kecamatan' => $request->kecamatan_faskes,
                'kelurahan' => $request->kelurahan_faskes,
                'koordinat' => $request->koordinat_lokasi,
                'ijin_berakhir' => Carbon::parse($request->tgl_berakhir)->format('Y-m-d'),
                'no_ijin' => $request->no_ijin,
            ];

            if ($item->update($faskes) && $item->user()->update($user)) {
                return redirect()->route('faskes.index')->with('success', 'Data Faskes berhasil diperbarui');
            } else {
                return redirect()->back()->with('danger', 'Data Faskes gagal diperbarui');
            }
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
        $faskes = User::with(['detail_faskes'])->where('kode_faskes', '=', Crypt::decrypt($id))->firstOrFail();
        try {
            // $faskes->user->delete();
            $faskes->delete();
            return redirect()->route('faskes.index')->with(['success' => 'Faskes berhasil dihapus!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with(['error' => 'Faskes gagal dihapus!']);
        }
    }
    public function restore($id)
    {
        $faskes = User::withTrashed()->where('role', '=', 'KLINIK')->where('kode_faskes', '=', Crypt::decrypt($id))->with(['detail_faskes'])->whereHas('detail_faskes', function ($query) {
            $query->where('faskes.status', '=', 'active');
            $query->orWhere('faskes.status', '=', 'inactive');
        })->firstOrFail();
        try {
            $faskes->restore();
            return redirect()->back()->with(['success' => 'Faskes berhasil direstore!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with(['error' => 'Faskes gagal direstore!']);
        }
    }
    public function resend($id)
    {
        $faskes = User::with(['detail_faskes'])->where('kode_faskes', '=', Crypt::decrypt($id))->firstOrFail();
        $data = [
            'nama' => $faskes->name,
            'email' => $faskes->email,
            'password' => $faskes->kode_faskes,
            'author' => 'Bidang SDK DKK Semarang',
        ];
        try {
            Mail::to($faskes->email)->send(new EmailLogin($data));
            return redirect()->back()->with('success', 'Berhasil mengirim email');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal mengirim email');
        }
    }
}