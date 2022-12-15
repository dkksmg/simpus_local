<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\MasterKecamatan;
use App\Models\MasterKelurahan;
use App\Models\MasterKotaKab;
use Illuminate\Http\Request;

class AjaxDropdown extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKelurahan(Request $request)
    {
        $data = Kecamatan::with(['kelurahan'])->where('kode_kecamatan', '=', $request->kode_kec)->firstOrFail();

        foreach ($data->kelurahan as $kel) {
            $kelurahan[] = [
                'nama_kel' => $kel->nama_kelurahan,
                'kode_kel' => $kel->kode_kelurahan,
                'kode_pos' => $kel->kode_pos,
            ];
        }
        return response()->json(
            array('kelurahan' => $kelurahan)
        );
    }
    public function fetchKotaKab(Request $request)
    {
        if ($request->ajax()) {

            $data = MasterKotaKab::where("provinsi_id", $request->prov_id)->orderBy('kota', 'DESC')->get(["id", "provinsi_id", "kota"]);

            return response()->json($data);
        }
    }
    public function fetchKecamatan(Request $request)
    {
        if ($request->ajax()) {

            $data = MasterKecamatan::where("kota_id", $request->kota_id)->orderBy('kecamatan', 'ASC')->get(["id", "kota_id", "kecamatan"]);
            return response()->json($data);
        }
    }
    public function fetchKelurahan(Request $request)
    {
        if ($request->ajax()) {

            $data = MasterKelurahan::where("kecamatan_id", $request->kec_id)->orderBy('kelurahan', 'ASC')->get(["id", "kecamatan_id", "kelurahan"]);

            return response()->json($data);
        }
    }
}