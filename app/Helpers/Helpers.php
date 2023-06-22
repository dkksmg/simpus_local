<?php

namespace App\Helpers;

use DateTime;
use Carbon\Carbon;
use App\Models\Obat;
use App\Models\User;
use App\Models\Nakes;
use App\Models\Faskes;
use App\Models\Pasien;
use GuzzleHttp\Client;
use App\Models\Tindakan;
use App\Models\Kelurahan;
use App\Models\Kunjungan;
use App\Models\Faskes\Poli;
use App\Models\JenisKlinik;
use App\Models\MasterKecamatan;
use App\Models\MasterKelurahan;
use App\Models\MasterKotaKab;
use App\Models\MasterProvinsi;
use App\Models\PelayananKlinik;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    private static $instance;
    private $urlData;
    public final function __construct()
    {
        $this->urlData = config('app.api_url_data');
    }
    public static function KodeFaskes($id)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $cek = User::count();
        $kode_kel = Kelurahan::select('kode_kelurahan')->where('id', '=', $id)->first();
        if ($cek == 0) {
            $urut = 101;
            $nomer =  $kode_kel->kode_kelurahan . $urut;
        } else {
            $ambil = User::all()->last();
            $urut = (int)substr($ambil->kode_faskes, -4) + 1;
            $nomer = $kode_kel->kode_kelurahan . $urut;
        }
        return $nomer;
    }
    public static function IdNakes($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $initial = preg_replace('/\b(\w)|./', '$1', Auth::user()->name);

        $cek = Nakes::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = $initial . '/NK/' . $urut;
        } else {
            $ambil = Nakes::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_nakes, -5) + 1;
            $nomer = $initial . '/NK/' . $urut;
        }
        return $nomer;
    }
    public static function IdObat($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $initial = preg_replace('/\b(\w)|./', '$1', Auth::user()->name);
        $cek = Obat::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = $initial . '/MED/' . $urut;
        } else {
            $ambil = Obat::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_obat, -5) + 1;
            $nomer = $initial . '/MED/' . $urut;
        }
        return $nomer;
    }
    public static function IdTindakan($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $initial = preg_replace('/\b(\w)|./', '$1', Auth::user()->name);
        $cek = Tindakan::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = $initial . '/TD/' . $urut;
        } else {
            $ambil = Tindakan::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_tindakan, -5) + 1;
            $nomer = $initial . '/TD/' . $urut;
        }
        return $nomer;
    }
    public static function IdPoli($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $initial = preg_replace('/\b(\w)|./', '$1', Auth::user()->name);
        $cek = Poli::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 101;
            $nomer = $initial . 'PL' . $urut;
        } else {
            $ambil = Poli::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_poli, -3) + 1;
            $nomer = $initial . 'PL' . $urut;
        }
        return $nomer;
    }
    public static function IDKunjungan($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $cek = Kunjungan::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 100001;
            $nomer =   $kode . '/VT/'  . $urut;
        } else {
            $ambil = Kunjungan::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->id_kunjungan, -5) + 1;
            $nomer =  $kode . '/VT/'  . $urut;
        }
        return $nomer;
    }
    public static function NoCmInsert($kode, $nama, $kl)
    {
        // inisial klinik
        $klinik = User::where('kode_faskes', '=', $kode)->first();
        // dd($klinik);
        $initial = preg_replace('/\b(\w)|./', '$1', $nama);
        // tgl dmy now
        $now = Carbon::now()->format('dmy');
        // 3 digit terakhir kode klinik
        // $kl = substr(Auth::user()->kode_faskes, -3);
        $cek = Pasien::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = $initial . '-' . $now . '-' . $kl . '-' . $urut;
        } else {
            $ambil = Pasien::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_pasien, -5) + 1;
            $nomer = $initial . '-' . $now . '-' . $kl . '-' . $urut;
        }
        return $nomer;
    }

    public static function JenisKlinik($jenis)
    {
        $klinik = JenisKlinik::where('nama_jenis', 'like', '%' . $jenis . '%')->first();

        return $klinik->id;
    }
    public static function PelayananKlinik($pelayanan)
    {
        $klinik = PelayananKlinik::where('nama_pelayanan', 'like', '%' . $pelayanan . '%')->first();

        return $klinik->id;
    }
    public static function getAge($dob)
    {
        $tanggal = new DateTime($dob);
        $today = new DateTime('today');
        $y = $today->diff($tanggal)->y;
        $m = $today->diff($tanggal)->m;
        $d = $today->diff($tanggal)->d;
        return $y . " tahun " . $m . " bulan " . $d . " hari";
    }
    public static function Datapasien()
    {
        $client = new Client();
        self::$instance = new Helpers;
        $endpoint = "pasien/";
        $params['headers'] = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        $response = $client->get(self::$instance->urlData . $endpoint, $params);
        $data = json_decode($response->getBody(), true);
        return $data;
    }
    public static function Dataklinik()
    {
        $client = new Client();
        self::$instance = new Helpers;
        $endpoint = "all/";
        $params['headers'] = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        $response = $client->get(self::$instance->urlData . $endpoint, $params);
        $data = json_decode($response->getBody(), true);
        return $data;
    }
    public static function DataObat()
    {
        $client = new Client();
        self::$instance = new Helpers;
        $endpoint = "obat/";
        $params['headers'] = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        $response = $client->get(self::$instance->urlData . $endpoint, $params);
        $data = json_decode($response->getBody(), true);
        return $data;
    }
    public static function DataTindakan()
    {
        $client = new Client();
        self::$instance = new Helpers;
        $endpoint = "tindakan/";
        $params['headers'] = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        $response = $client->get(self::$instance->urlData . $endpoint, $params);
        $data = json_decode($response->getBody(), true);
        return $data;
    }
    public static function DataNakes()
    {
        $client = new Client();
        self::$instance = new Helpers;
        $endpoint = "dokter/";
        $params['headers'] = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        $response = $client->get(self::$instance->urlData . $endpoint, $params);
        $data = json_decode($response->getBody(), true);
        return $data;
    }
    public static function cariFaskes($kode)
    {
        $user = User::where('kode_faskes', '=', $kode)->first();
        if ($user != null) {
            $nama = $user->name;
        } else {
            $nama = 'NN';
        }

        return $nama;
    }
    public static function IdObatInsert($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $initial = preg_replace('/\b(\w)|./', '$1', self::cariFaskes($kode));

        $cek = Obat::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = $initial . '/MED/' . $urut;
        } else {
            $ambil = Obat::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_obat, -5) + 1;
            $nomer = $initial . '/MED/' . $urut;
        }
        return $nomer;
    }
    public static function IdTindakanInsert($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $initial = preg_replace('/\b(\w)|./', '$1', self::cariFaskes($kode));
        $cek = Tindakan::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = $initial . '/TD/' . $urut;
        } else {
            $ambil = Tindakan::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_tindakan, -5) + 1;
            $nomer = $initial . '/TD/' . $urut;
        }
        return $nomer;
    }
    public static function IdNakesInsert($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $initial = preg_replace('/\b(\w)|./', '$1', self::cariFaskes($kode));
        $cek = Nakes::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = $initial . '/NK/' . $urut;
        } else {
            $ambil = Nakes::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_nakes, -5) + 1;
            $nomer = $initial . '/NK/' . $urut;
        }
        return $nomer;
    }
    public static function Provinsi($prov)
    {
        $provinsi = MasterProvinsi::where('nama', 'like', '%' . $prov)->first();

        return $provinsi->kode_provinsi;
    }
    public static function Kota($kota)
    {
        $kota = MasterKotaKab::where('nama', 'like', '%' . $kota)->first();

        return $kota->kode_kotakab;
    }
    public static function Kecamatan($kec)
    {
        $kecamatan = MasterKecamatan::where('nama', 'like', '%' . $kec)->first();

        return $kecamatan->kode_kecamatan;
    }
    public static function Kelurahan($kel)
    {
        $kelurahan = MasterKelurahan::where('nama', 'like', '%' . $kel)->first();

        return $kelurahan->kode_kelurahan;
    }
}
