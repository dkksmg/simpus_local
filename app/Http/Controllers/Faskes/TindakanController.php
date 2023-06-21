<?php

namespace App\Http\Controllers\Faskes;

use App\Models\Obat;
use App\Helpers\Helpers;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tindakan::where('kode_faskes', '=', Auth::user()->kode_faskes)
                ->with(['detail_faskes'])->whereHas('detail_faskes', function ($query) {
                    $query->where('faskes.status', '=', 'active');
                    $query->orWhere('faskes.status', '=', 'inactive');
                })->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<table><tbody><tr class="text-center">';
                    $btn = $btn . '<td class="text-center">
                    <button class="btn btn-warning btn-sm me-2" title="Edit Data ' . $row->name . '" onclick="window.location.href=\'' . route('faskes.tindakan.edit', Crypt::encrypt($row->kode_tindakan)) . '\'" ><i class="fa-solid fa-pencil"></i></button>
                    </td>';
                    $btn = $btn . '<td class="text-center">
                    <form action="' . route('faskes.tindakan.destroy', Crypt::encrypt($row->kode_tindakan)) . '" method="post" class="d-inline" title="Hapus Data Tindakan '  . $row->name . '">
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
                ->editColumn('tarif_tindakan', function ($data) {
                    $tarif = "Rp " . number_format($data->tarif_tindakan, 0, ',', '.');;
                    return $tarif;
                })
                ->make(true);
        }
        return view('pages.faskes.klinik.tindakan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_tindakan = Helpers::IdTindakan(Auth::user()->kode_faskes);
        return view('pages.faskes.klinik.tindakan.create', compact(['kode_tindakan']));
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
                'kode_tindakan' => 'required|string',
                'detail_tindakan' => 'required|string',
                'tarif_tindakan' => 'required|numeric',
            ],
            [
                'kode_tindakan.required' => 'Kode Tindakan tidak boleh kosong',
                'kode_tindakan.string' => 'Kode Tindakan hanya dapat berisi alphanumeric',
                'detail_tindakan.required' => 'Detail Tindakan tidak boleh kosong',
                'detail_tindakan.string' => 'Detail Tindakan hanya dapat berisi alphanumeric',
                'tarif_tindakan.required' => 'Tarif Tindakan tidak boleh kosong',
                'tarif_tindakan.numeric' => 'Tarif Tindakan hanya berupa angka',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $data = [
                'kode_faskes' => Auth::user()->kode_faskes,
                'kode_tindakan' => $request->kode_tindakan,
                'detail_tindakan' => $request->detail_tindakan,
                'tarif_tindakan' => (int) preg_replace('/\D/', '', $request->tarif_tindakan),
            ];
            if (Tindakan::create($data)) {
                return redirect()->route('faskes.tindakan')->with('success', 'Data Tindakan berhasil disimpan');
            } else {
                return redirect()->back()->with('danger', 'Gagal menyimpan data tindakan');
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
        $tindakan = Tindakan::where('kode_tindakan', '=', Crypt::decrypt($id))->firstOrFail();

        return view('pages.faskes.klinik.tindakan.edit', [
            'tindakan' => $tindakan
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
        $tindakan = Tindakan::where('kode_tindakan', '=', Crypt::decrypt($id))->firstOrFail();

        $validateData = Validator::make(
            $request->all(),
            [
                'kode_tindakan' => 'required|string',
                'detail_tindakan' => 'required|string',
                'tarif_tindakan' => 'required|numeric',
            ],
            [
                'kode_tindakan.required' => 'Kode Tindakan tidak boleh kosong',
                'kode_tindakan.string' => 'Kode Tindakan hanya dapat berisi alphanumeric',
                'detail_tindakan.required' => 'Detail Tindakan tidak boleh kosong',
                'detail_tindakan.string' => 'Detail Tindakan hanya dapat berisi alphanumeric',
                'tarif_tindakan.required' => 'Tarif Tindakan tidak boleh kosong',
                'tarif_tindakan.numeric' => 'Tarif Tindakan hanya berupa angka',
            ]
        );
        if ($validateData->fails()) {
            return back()->with('toast_error', $validateData->getMessageBag()->all()[0])->withInput();
        } else {
            $data = [
                'kode_faskes' => Auth::user()->kode_faskes,
                'kode_tindakan' => $request->kode_tindakan,
                'detail_tindakan' => $request->detail_tindakan,
                'tarif_tindakan' => (int) preg_replace('/\D/', '', $request->tarif_tindakan),
            ];
            if ($tindakan->update($data)) {
                return redirect()->route('faskes.tindakan')->with('success', 'Data Tindakan berhasil diperbarui');
            } else {
                return redirect()->back()->with('danger', 'Gagal memperbarui data tindakan');
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
        $tindakan = Tindakan::where('kode_tindakan', '=', Crypt::decrypt($id))->firstOrFail();
        if ($tindakan->delete()) {
            return redirect()->back()->with(['success' => 'Data Tindakan berhasil dihapus!']);
        } else {
            return redirect()->back()->with(['error' => 'Data Tindakan gagal dihapus!']);
        }
    }
    public function ambilTindakan()
    {
        try {

            $klinik = Helpers::DataTindakan();
            foreach ($klinik['data']['tindakan'] as $kl) {
                $obat = [
                    'kode_faskes' => $kl['klinik'],
                    'kode_tindakan' => Helpers::IdTindakanInsert($kl['klinik']),
                    'kode_tindakan_lama' => $kl['kdTindakan'],
                    'detail_tindakan' => $kl['nmTindakan'],
                    'tarif_tindakan' => $kl['tarif'],
                ];
                Tindakan::create($obat);
            }
            echo 'berhasil tersimpan';
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
