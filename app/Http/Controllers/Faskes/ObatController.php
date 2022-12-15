<?php

namespace App\Http\Controllers\Faskes;

use App\Models\Obat;
use App\Models\Nakes;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Obat::where('kode_faskes', '=', Auth::user()->kode_faskes)
                ->with(['detail_faskes'])->whereHas('detail_faskes', function ($query) {
                    $query->where('faskes.status', '=', 'active');
                    $query->orWhere('faskes.status', '=', 'inactive');
                })->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<table><tbody><tr class="text-center">';
                    $btn = $btn . '<td class="text-center">
                    <button class="btn btn-warning btn-sm me-2" title="Edit Data ' . $row->name . '" onclick="window.location.href=\'' . route('faskes.obat.edit', Crypt::encrypt($row->kode_obat)) . '\'" ><i class="fa-solid fa-pencil"></i></button>
                    </td>';
                    $btn = $btn . '<td class="text-center">
                    <form action="' . route('faskes.obat.destroy', Crypt::encrypt($row->kode_obat)) . '" method="post" class="d-inline" title="Hapus Data Obat '  . $row->name . '">
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
                ->editColumn('tarif_obat', function ($data) {
                    $tarif = "Rp " . number_format($data->tarif_obat, 0, ',', '.');;
                    return $tarif;
                })
                ->make(true);
        }
        return view('pages.faskes.klinik.obat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_obat = Helpers::IdObat(Auth::user()->kode_faskes);
        return view('pages.faskes.klinik.obat.create', compact(['kode_obat']));
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
                'kode_obat' => 'required|string',
                'nama_obat' => 'required|string',
                'jenis_obat' => 'required|alpha_num',
                'pabrik_obat' => 'string',
                'dosis_obat' => 'string',
                'tarif_obat' => 'required|numeric',
            ],
            [
                'kode_obat.required' => 'Kode Obat tidak boleh kosong',
                'kode_obat.string' => 'Kode Obat hanya dapat berisi alphanumeric',
                'nama_obat.required' => 'Nama Obat tidak boleh kosong',
                'nama_obat.string' => 'Nama Obat hanya dapat berisi alphanumeric',
                'jenis_obat.required' => 'Jenis Obat tidak boleh kosong',
                'jenis_obat.alpha_num' => 'Jenis Obat hanya dapat berisi alphanumeric',
                'dosis_obat.string' => 'Nama Obat hanya dapat berisi alphanumeric',
                'tarif_obat.required' => 'Tarif Obat tidak boleh kosong',
                'tarif_obat.numeric' => 'Tarif Obat hanya berupa angka',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $data = [
                'kode_faskes' => Auth::user()->kode_faskes,
                'kode_obat' => $request->kode_obat,
                'nama_obat' => $request->nama_obat,
                'jenis_obat' => $request->jenis_obat,
                'pabrik_obat' => $request->pabrik_obat,
                'dosis_obat' => $request->dosis_obat,
                'tarif_obat' => (int) preg_replace('/\D/', '', $request->tarif_obat),
            ];
            if (Obat::create($data)) {
                return redirect()->route('faskes.obat')->with('success', 'Data Obat berhasil disimpan');
            } else {
                return redirect()->back()->with('danger', 'Gagal menyimpan data obat');
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
        $obat = Obat::where('kode_obat', '=', Crypt::decrypt($id))->firstOrFail();

        return view('pages.faskes.klinik.obat.edit', [
            'obat' => $obat
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
        $obat = Obat::where('kode_obat', '=', Crypt::decrypt($id))->firstOrFail();
        $validateData = Validator::make(
            $request->all(),
            [
                'kode_obat' => 'required|string',
                'nama_obat' => 'required|string',
                'pabrik_obat' => 'string',
                'dosis_obat' => 'string',
                'tarif_obat' => 'required|numeric',
            ],
            [
                'kode_obat.required' => 'Kode Obat tidak boleh kosong',
                'kode_obat.string' => 'Kode Obat hanya dapat berisi alphanumeric',
                'nama_obat.required' => 'Nama Obat tidak boleh kosong',
                'nama_obat.string' => 'Nama Obat hanya dapat berisi alphanumeric',
                'dosis_obat.string' => 'Nama Obat hanya dapat berisi alphanumeric',
                'tarif_obat.required' => 'Tarif Obat tidak boleh kosong',
                'tarif_obat.numeric' => 'Tarif Obat hanya berupa angka',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $data = [
                'kode_faskes' => Auth::user()->kode_faskes,
                'kode_obat' => $request->kode_obat,
                'nama_obat' => $request->nama_obat,
                'pabrik_obat' => $request->pabrik_obat,
                'dosis_obat' => $request->dosis_obat,
                'tarif_obat' => (int) preg_replace('/\D/', '', $request->tarif_obat),
            ];
            if ($obat->update($data)) {
                return redirect()->route('faskes.obat')->with('success', 'Data Obat berhasil disimpan');
            } else {
                return redirect()->back()->with('danger', 'Gagal menyimpan data obat');
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
        $obat = Obat::where('kode_obat', '=', Crypt::decrypt($id))->firstOrFail();
        if ($obat->delete()) {
            return redirect()->back()->with(['success' => 'Data Obat berhasil dihapus!']);
        } else {
            return redirect()->back()->with(['error' => 'Data Obat gagal dihapus!']);
        }
    }
}