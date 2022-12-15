<?php

namespace App\Http\Controllers\Faskes;

use App\Models\Nakes;
use App\Helpers\Helpers;
use App\Models\Faskes\Poli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Poli::where('kode_faskes', '=', Auth::user()->kode_faskes)
                ->where('status', '=', 'active')
                ->orWhere('status', '=', 'inactive')
                ->with(['detail_faskes'])->whereHas('detail_faskes', function ($query) {
                    $query->where('faskes.status', '=', 'active');
                    $query->orWhere('faskes.status', '=', 'inactive');
                })->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<table><tbody><tr class="text-center">';
                    if ($row->status == "active") {
                        $btn = $btn . '<td class="text-center">
                        <form action="' . route('faskes.poli.nonaktifkan', Crypt::encrypt($row->kode_poli)) . '" method="post" class="d-inline" title="Nonaktifkan Data Poli '  . $row->nama_poli . '">
                        ' . method_field('PUT') . '
                        ' . csrf_field() . '
                        <button class="btn btn-dark btn-sm me-2"><i class="fa-solid fa-circle-xmark"></i>
                    </button>
                        </form>
                        </td>';
                    } else {
                        $btn = $btn . '<td class="text-center">
                        <form action="' . route('faskes.poli.aktifkan', Crypt::encrypt($row->kode_poli)) . '" method="post" class="d-inline" title="Aktifkan Data Poli '  . $row->nama_poli . '">
                        ' . method_field('PUT') . '
                        ' . csrf_field() . '
                        <button class="btn btn-success btn-sm me-2"><i class="fa-solid fa-badge-check"></i>
                    </button>
                        </form>
                        </td>';
                    }
                    $btn = $btn . '<td class="text-center">

                    <button class="btn btn-warning btn-sm me-2" title="Edit Data ' . $row->nama_poli . '" onclick="window.location.href=\'' . route('faskes.poli.edit', Crypt::encrypt($row->kode_poli)) . '\'" ><i class="fa-solid fa-pencil"></i></button>

                    </td>';
                    $btn = $btn . '<td class="text-center">
                    <form action="' . route('faskes.poli.destroy', Crypt::encrypt($row->kode_poli)) . '" method="post" class="d-inline" title="Hapus Data Poli '  . $row->nama_poli . '">
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
        return view('pages.faskes.klinik.poli.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_poli = Helpers::IdPoli(Auth::user()->kode_faskes);
        return view('pages.faskes.klinik.poli.create', [
            'kode_poli' => $kode_poli,
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
                'kode_poli' => 'required|string',
                'nama_poli' => 'required|string',
                'status_poli' => 'required',
            ],
            [
                'kode_poli.required' => 'Kode Poli tidak boleh kosong',
                'nama_poli.required' => 'Nama Poli tidak boleh kosong',
                'nama_poli.string' => 'Nama Poli harus berupastring',
                'status_poli.required' => 'Status Poli tidak boleh kosong',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $data = [
                'kode_faskes' => Auth::user()->kode_faskes,
                'kode_poli' => $request->kode_poli,
                'nama_poli' => $request->nama_poli,
                'status' => $request->status_poli,
            ];

            if (Poli::create($data)) {
                return redirect()->route('faskes.poli')->with('success', 'Data Poli berhasil disimpan');
            } else {
                return redirect()->back()->with('danger', 'Gagal menyimpan data poli');
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
        $poli = Poli::where('kode_poli', '=', Crypt::decrypt($id))->firstOrFail();
        return view('pages.faskes.klinik.poli.edit', compact('poli'));
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
        $poli = Poli::where('kode_poli', '=', Crypt::decrypt($id))->firstOrFail();
        $validateData = Validator::make(
            $request->all(),
            [
                'kode_poli' => 'required|string',
                'nama_poli' => 'required|string',
                'status_poli' => 'required',
            ],
            [
                'kode_poli.required' => 'Kode Poli tidak boleh kosong',
                'nama_poli.required' => 'Nama Poli tidak boleh kosong',
                'nama_poli.string' => 'Nama Poli harus berupastring',
                'status_poli.required' => 'Status Poli tidak boleh kosong',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $data = [
                'kode_faskes' => Auth::user()->kode_faskes,
                'kode_poli' => $request->kode_poli,
                'nama_poli' => $request->nama_poli,
                'status' => $request->status_poli,
            ];

            if ($poli->update($data)) {
                return redirect()->route('faskes.poli')->with('success', 'Data Poli berhasil diperbarui');
            } else {
                return redirect()->back()->with('danger', 'Gagal memperbarui data poli');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function NonaktifkanPoli($id)
    {
        $poli = Poli::where('kode_poli', '=', Crypt::decrypt($id))->firstOrFail();
        if ($poli->update(['status' => 'inactive'])) {
            return redirect()->back()->with(['success' => 'Poli berhasil dinonaktifkan!']);
        } else {
            return redirect()->back()->with(['error' => 'Poli gagal dinonaktifkan!']);
        }
    }
    public function AktifkanPoli($id)
    {
        $poli = Poli::where('kode_poli', '=', Crypt::decrypt($id))->firstOrFail();
        if ($poli->update(['status' => 'active'])) {
            return redirect()->back()->with(['success' => 'Poli berhasil diaktifkan!']);
        } else {
            return redirect()->back()->with(['error' => 'Poli gagal diaktifkan!']);
        }
    }
    public function destroy($id)
    {
        $poli = Poli::where('kode_poli', '=', Crypt::decrypt($id))->firstOrFail();
        if ($poli->delete()) {
            return redirect()->back()->with(['success' => 'Poli berhasil dihapus!']);
        } else {
            return redirect()->back()->with(['error' => 'Poli gagal dihapus!']);
        }
    }
}