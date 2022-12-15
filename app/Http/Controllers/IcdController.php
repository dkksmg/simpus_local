<?php

namespace App\Http\Controllers;

use App\Models\Icdref;
use Illuminate\Http\Request;
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
        $ICD = Icdref::select('kode_icd', 'diagnosis')->latest();

        return DataTables::of(Icdref::query())
            ->editColumn('kode_icd', function ($data) {
                // $btn = "<a href=\"javascript:void(0)\" class='btn btn-sm btn-default' onclick=\"input('" . $data->kode_icd . "','" . $data->diagnosis . "')\">" . $data->kode_icd . "</a>";
                // $btn = "<a href=\"javascript:void(0)\" class='btn btn-sm btn-default' onclick=\"alert('Tes Log')\">" . $data->kode_icd . "</a>";

                // $btn = '<button class="btn btn-outline-warning btn-sm" title="Pilih ICD" onclick="window.location.href=\'' . route('faskes.nakes.edit', Crypt::encrypt($row->kode_nakes)) . '\'" >' . $data->kode_icd . '</button>';

                $btn = '<button class="btn btn-outline-info btn-sm" title="Pilih ICD" onclick="return input(\'' . $data->kode_icd . '\',\'' . $data->diagnosis . '\')" >' . $data->kode_icd . '</button>';
                return $btn;
            })
            ->rawColumns(['kode_icd'])
            ->make(true);
    }
    public function tampilICD($ke = null)
    {
        // return view('tampil');
        return view('pages.faskes.klinik.pemeriksaan.popup-diagnosa', array('ke' => $ke));
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