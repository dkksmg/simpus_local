<?php

namespace App\Http\Controllers;

use App\Models\Icdref;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class IcdController extends Controller
{
    public function listICD(Request $request)
    {
        // if ($request->ajax()) {
        $ICD = Icdref::select('id', 'kode_icd', 'diagnosis')->where('kode_icd', '=', $request->icd)->first();
        // if ($ICD != null){

        // }
        return response()->json(
            array(
                "status" => $ICD == null ? false : true,
                "data" => $ICD == null ? null :
                    [
                        'icd' => $ICD->kode_icd,
                        'diagnosa' => $ICD->diagnosis
                    ]
            )
        );
        // }
    }
    public function popupICD()
    {

        return DataTables::of(Icdref::query())
            ->editColumn('kode_icd', function ($data) {
                $btn = '<button class="btn btn-outline-info btn-sm" title="Pilih ICD" onclick="return input(\'' . $data->kode_icd . '\',\'' . $data->diagnosis . '\')" >' . $data->kode_icd . '</button>';
                return $btn;
            })
            ->rawColumns(['kode_icd'])
            ->make(true);
    }
    public function popupTindakan()
    {
        return DataTables::of(Tindakan::query()->where('kode_faskes', '=', Auth::user()->kode_faskes))
            ->editColumn('kode_tindakan', function ($data) {
                $btn = '<button class="btn btn-outline-info btn-sm" title="Pilih Tindakan" onclick="return input(\'' . $data->kode_tindakan . '\',\'' . $data->detail_tindakan . '\')" >' . $data->kode_tindakan . '</button>';
                return $btn;
            })
            ->editColumn('tarif_tindakan', function ($data) {
                $tarif = "Rp " . number_format($data->tarif_tindakan, 0, ',', '.');
                return $tarif;
            })
            ->rawColumns(['kode_tindakan'])
            ->make(true);
    }
    public function popupObat()
    {
        return DataTables::of(Obat::query()->where('kode_faskes', '=', Auth::user()->kode_faskes))
            ->editColumn('kode_obat', function ($data) {
                $btn = '<button class="btn btn-outline-info btn-sm" title="Pilih Tindakan" onclick="return input(\'' . $data->kode_obat . '\',\'' . $data->nama_obat . '\')" >' . $data->kode_obat . '</button>';
                return $btn;
            })
            ->editColumn('tarif_tindakan', function ($data) {
                $tarif = "Rp " . number_format($data->tarif_tindakan, 0, ',', '.');
                return $tarif;
            })
            ->rawColumns(['kode_obat'])
            ->make(true);
    }
    public function tampilICD($ke = null)
    {
        return view('pages.faskes.klinik.pemeriksaan.popup-diagnosa', array('ke' => $ke));
    }
    public function tampilTindakan($ke = null)
    {
        return view('pages.faskes.klinik.pemeriksaan.popup-tindakan', array('ke' => $ke));
    }
    public function tampilObat($ke = null)
    {
        return view('pages.faskes.klinik.pemeriksaan.popup-obat', array('ke' => $ke));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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