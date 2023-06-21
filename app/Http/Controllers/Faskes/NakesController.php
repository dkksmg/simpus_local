<?php

namespace App\Http\Controllers\Faskes;

use App\Models\User;
use App\Models\Nakes;
use App\Helpers\Helpers;
use App\Models\JabatanNakes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NakesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Nakes::where('kode_faskes', '=', Auth::user()->kode_faskes,)
                ->where('status', '=', 'active')
                ->orWhere('status', '=', 'inactive')
                ->with(['detail_faskes', 'detail_jabatan'])->whereHas('detail_faskes', function ($query) {
                    $query->where('faskes.status', '=', 'active');
                    $query->orWhere('faskes.status', '=', 'inactive');
                })->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<table><tbody><tr class="text-center">';
                    if ($row->status == "active") {
                        $btn = $btn . '<td class="text-center">
                        <form action="' . route('faskes.nakes.nonaktifkan', Crypt::encrypt($row->kode_nakes)) . '" method="post" class="d-inline" title="Nonaktifkan Data Nakes '  . $row->name . '">
                        ' . method_field('PUT') . '
                        ' . csrf_field() . '
                        <button class="btn btn-dark btn-sm me-2"><i class="fa-solid fa-circle-xmark"></i>
                    </button>
                        </form>
                        </td>';
                    } else {
                        $btn = $btn . '<td class="text-center">
                        <form action="' . route('faskes.nakes.aktifkan', Crypt::encrypt($row->kode_nakes)) . '" method="post" class="d-inline" title="Aktifkan Data Nakes '  . $row->name . '">
                        ' . method_field('PUT') . '
                        ' . csrf_field() . '
                        <button class="btn btn-success btn-sm me-2"><i class="fa-solid fa-badge-check"></i>
                    </button>
                        </form>
                        </td>';
                    }
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
                ->rawColumns(['action'])
                ->editColumn('jabatan_nakes', function ($data) {
                    $formatedDate = ucfirst($data->jabatan_nakes);
                    return $formatedDate;
                })
                ->make(true);
        }
        return view('pages.faskes.klinik.nakes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_nakes = Helpers::IdNakes(Auth::user()->kode_faskes);
        $jabatan = JabatanNakes::all();
        return view('pages.faskes.klinik.nakes.create', compact(['kode_nakes', 'jabatan']));
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
                'kode_nakes' => 'required|string',
                'nama_nakes' => 'required|string',
                'jabatan_nakes' => 'required',
                'status_nakes' => 'required',
            ],
            [
                'kode_nakes.required' => 'Kode Nakes tidak boleh kosong',
                'nama_nakes.required' => 'Nama Nakes tidak boleh kosong',
                'jabatan_nakes.required' => 'Jabatan Nakes tidak boleh kosong',
                'status_nakes.required' => 'Status Nakes tidak boleh kosong',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $nakes = [
                'kode_faskes' => Auth::user()->kode_faskes,
                'kode_nakes' => $request->kode_nakes,
                'nama_nakes' => $request->nama_nakes,
                'jabatan_nakes' => $request->jabatan_nakes,
                'status' => $request->status_nakes,
            ];

            if (Nakes::create($nakes)) {
                return redirect()->route('faskes.nakes')->with('success', 'Data Nakes berhasil disimpan');
            } else {
                return redirect()->back()->with('danger', 'Gagal menyimpan data nakes');
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
        $jabatan = JabatanNakes::all();
        $nakes = Nakes::with(['detail_jabatan'])->where('kode_nakes', '=', Crypt::decrypt(($id)))->firstOrFail();
        return view('pages.faskes.klinik.nakes.edit', compact(['jabatan', 'nakes']));
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
        $item = Nakes::where('kode_nakes', '=', Crypt::decrypt($id))->firstOrFail();
        $validateData = Validator::make(
            $request->all(),
            [
                'kode_nakes' => 'required|string',
                'nama_nakes' => 'required|string',
                'jabatan_nakes' => 'required',
                'status_nakes' => 'required',
            ],
            [
                'kode_nakes.required' => 'Kode Nakes tidak boleh kosong',
                'nama_nakes.required' => 'Nama Nakes tidak boleh kosong',
                'jabatan_nakes.required' => 'Jabatan Nakes tidak boleh kosong',
                'status_nakes.required' => 'Status Nakes tidak boleh kosong',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $nakes = [
                'kode_faskes' => Auth::user()->kode_faskes,
                'kode_nakes' => $request->kode_nakes,
                'nama_nakes' => $request->nama_nakes,
                'jabatan_nakes' => $request->jabatan_nakes,
                'status' => $request->status_nakes,
            ];

            if ($item->update($nakes)) {
                return redirect()->route('faskes.nakes')->with('success', 'Data Nakes berhasil diperbarui');
            } else {
                return redirect()->back()->with('danger', 'Gagal memperbarui data nakes');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function NonaktifkanNakes($id)
    {
        $nakes = Nakes::where('kode_nakes', '=', Crypt::decrypt($id))->firstOrFail();
        if ($nakes->update(['status' => 'inactive'])) {
            return redirect()->back()->with(['success' => 'Nakes berhasil dinonaktifkan!']);
        } else {
            return redirect()->back()->with(['error' => 'Nakes gagal dinonaktifkan!']);
        }
    }
    public function AktifkanNakes($id)
    {
        $nakes = Nakes::where('kode_nakes', '=', Crypt::decrypt($id))->firstOrFail();
        if ($nakes->update(['status' => 'active'])) {
            return redirect()->back()->with(['success' => 'Nakes berhasil diaktifkan!']);
        } else {
            return redirect()->back()->with(['error' => 'Nakes gagal diaktifkan!']);
        }
    }
    public function destroy($id)
    {
        $nakes = Nakes::where('kode_nakes', '=', Crypt::decrypt($id))->firstOrFail();
        if ($nakes->delete()) {
            return redirect()->back()->with(['success' => 'Nakes berhasil dihapus!']);
        } else {
            return redirect()->back()->with(['error' => 'Nakes gagal dihapus!']);
        }
    }
    public function ambilNakes()
    {
        try {

            $klinik = Helpers::DataNakes();
            foreach ($klinik['data']['nakes'] as $kl) {
                $obat = [
                    'kode_faskes' => $kl['klinik'],
                    'kode_nakes' => Helpers::IdNakesInsert($kl['klinik']),
                    'kode_nakes_lama' => $kl['kdDokter'],
                    'nama_nakes' => $kl['nmDokter'],
                    'jabatan_nakes' => 1,
                    'status' => 'active',
                ];
                Nakes::create($obat);
            }
            echo 'berhasil tersimpan';
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
