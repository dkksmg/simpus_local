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

            try {
                $data = MasterKotaKab::where("kode_provinsi", $request->prov)->orderBy('nama', 'ASC')->get();

                foreach ($data as $kota) {
                    $dataKota[] = array(
                        'kode_prov' => $kota->kode_provinsi,
                        'kode_kab' => $kota->kode_kotakab,
                        'nama' => $kota->nama,
                    );
                }
                return response()->json(array(
                    'status' => true,
                    'message' => 'Berhasil mendapatkan data',
                    'data' => $dataKota,
                    'statusCode' => 200
                ), 200);
            } catch (\Throwable $th) {
                return response()->json(array(
                    'status' => false,
                    'message' => $th->getMessage(),
                    'data' => null,
                    'statusCode' => $th->getCode()
                ), $th->getCode());
            }
        }
    }
    public function fetchKecamatan(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = MasterKecamatan::where("kode_kotakab", $request->kota)->orderBy('nama', 'ASC')->get();

                foreach ($data as $kecamatan) {
                    $dataKecamatan[] = array(
                        'kode_prov' => $kecamatan->kode_provinsi,
                        'kode_kab' => $kecamatan->kode_kotakab,
                        'kode_kec' => $kecamatan->kode_kecamatan,
                        'nama' => ucwords($kecamatan->nama),
                    );
                }
                return response()->json(array(
                    'status' => true,
                    'message' => 'Berhasil mendapatkan data',
                    'data' => $dataKecamatan,
                    'statusCode' => 200
                ), 200);
            } catch (\Throwable $th) {
                return response()->json(array(
                    'status' => false,
                    'message' => $th->getMessage(),
                    'data' => null,
                    'statusCode' => $th->getCode()
                ), $th->getCode());
            }
        }
    }
    public function fetchKelurahan(Request $request)
    {
        try {
            $data = MasterKelurahan::where("kode_kecamatan", $request->kec)->orderBy('nama', 'ASC')->get();

            foreach ($data as $kelurahan) {
                $dataKelurahan[] = array(
                    'kode_prov' => $kelurahan->kode_provinsi,
                    'kode_kab' => $kelurahan->kode_kotakab,
                    'kode_kec' => $kelurahan->kode_kecamatan,
                    'kode_kel' => $kelurahan->kode_kelurahan,
                    'nama' => ucwords($kelurahan->nama),
                );
            }
            return response()->json(array(
                'status' => true,
                'message' => 'Berhasil mendapatkan data',
                'data' => $dataKelurahan,
                'statusCode' => 200
            ), 200);
        } catch (\Throwable $th) {
            return response()->json(array(
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null,
                'statusCode' => $th->getCode()
            ), $th->getCode());
        }
    }
}
