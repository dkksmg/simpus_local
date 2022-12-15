<?php

namespace App\Helpers;

use DateTime;
use Carbon\Carbon;
use App\Models\Obat;
use App\Models\User;
use App\Models\Nakes;
use App\Models\Faskes;
use App\Models\Faskes\Poli;
use App\Models\Pasien;
use App\Models\Tindakan;
use App\Models\Kelurahan;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\Auth;

class Helpers
{
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
        $cek = Nakes::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 101;
            $nomer = $kode . 'NK' . $urut;
        } else {
            $ambil = Nakes::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_nakes, -3) + 1;
            $nomer = $kode . 'NK' . $urut;
        }
        return $nomer;
    }
    public static function IdObat($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $cek = Obat::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 101;
            $nomer = $kode . 'MED' . $urut;
        } else {
            $ambil = Obat::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_obat, -3) + 1;
            $nomer = $kode . 'MED' . $urut;
        }
        return $nomer;
    }
    public static function IdTindakan($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $cek = Tindakan::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 101;
            $nomer = $kode . 'TD' . $urut;
        } else {
            $ambil = Tindakan::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_tindakan, -3) + 1;
            $nomer = $kode . 'TD' . $urut;
        }
        return $nomer;
    }
    public static function IdPoli($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $cek = Poli::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 101;
            $nomer = $kode . 'PL' . $urut;
        } else {
            $ambil = Poli::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->kode_poli, -3) + 1;
            $nomer = $kode . 'PL' . $urut;
        }
        return $nomer;
    }
    public static function IDKunjungan($kode)
    {
        // $now = Carbon::now();
        // $date_now = $now->year . $now->month . $now->day;
        $cek = Kunjungan::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 101;
            $nomer = 'VT' . $kode  . $urut;
        } else {
            $ambil = Kunjungan::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->id_kunjungan, -3) + 1;
            $nomer = 'VT' . $kode  . $urut;
        }
        return $nomer;
    }
    public static function NoCm($kode)
    {
        // inisial klinik
        $initial = preg_replace('/\b(\w)|./', '$1', Auth::user()->name);
        // tgl dmy now
        $now = Carbon::now()->format('dmy');
        // 3 digit terakhir kode klinik
        $kl = substr(Auth::user()->kode_faskes, -3);
        $cek = Pasien::where('kode_faskes', '=', $kode)->count();
        if ($cek == 0) {
            $urut = 101;
            $nomer = $initial . $kl . $now . $urut;
        } else {
            $ambil = Pasien::where('kode_faskes', '=', $kode)->orderBy('id', 'DESC')->first();
            $urut = (int)substr($ambil->no_cm, -3) + 1;
            $nomer = $initial . $kl . $now . $urut;
        }
        return $nomer;
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
}