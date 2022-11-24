<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelurahans = [
            ["id_kecamatan" => "1", "nama_kelurahan" => "Ngesrep", "kode_pos" => "50261", "kode_kelurahan" => "3374111008
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Tinjomoyo", "kode_pos" => "50262", "kode_kelurahan" => "3374111009
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Srondol Kulon", "kode_pos" => "50263", "kode_kelurahan" => "3374111006
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Srondol Wetan", "kode_pos" => "50263", "kode_kelurahan" => "3374111007
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Banyumanik", "kode_pos" => "50264", "kode_kelurahan" => "3374111005
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Pudakpayung", "kode_pos" => "50265", "kode_kelurahan" => "3374111001
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Gedawang", "kode_pos" => "50266", "kode_kelurahan" => "3374111002
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Jabungan", "kode_pos" => "50266", "kode_kelurahan" => "3374111003
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Padangsari", "kode_pos" => "50267", "kode_kelurahan" => "3374111010
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Pedalangan", "kode_pos" => "50268", "kode_kelurahan" => "3374111004
            "],
            ["id_kecamatan" => "1", "nama_kelurahan" => "Sumurboto", "kode_pos" => "50269", "kode_kelurahan" => "3374111011
            "],

            ["id_kecamatan" => "2", "nama_kelurahan" => "Tegalsari", "kode_pos" => "50251", "kode_kelurahan" => "3374081006
            "],
            ["id_kecamatan" => "2", "nama_kelurahan" => "Wonotingal", "kode_pos" => "50252", "kode_kelurahan" => "3374081007
            "],
            ["id_kecamatan" => "2", "nama_kelurahan" => "Kaliwiru", "kode_pos" => "50253", "kode_kelurahan" => "3374081003
            "],
            ["id_kecamatan" => "2", "nama_kelurahan" => "Jatingaleh", "kode_pos" => "50254", "kode_kelurahan" => "3374081002
            "],
            ["id_kecamatan" => "2", "nama_kelurahan" => "Karanganyar Gunung", "kode_pos" => "50255", "kode_kelurahan" => "3374081005
            "],
            ["id_kecamatan" => "2", "nama_kelurahan" => "Jomblang", "kode_pos" => "50256", "kode_kelurahan" => "3374081004
            "],
            ["id_kecamatan" => "2", "nama_kelurahan" => "Candi", "kode_pos" => "50257", "kode_kelurahan" => "3374081001
            "],
            ["id_kecamatan" => "3", "nama_kelurahan" => "Bendungan", "kode_pos" => "50231", "kode_kelurahan" => "3374091008
            "],
            ["id_kecamatan" => "3", "nama_kelurahan" => "Lempongsari", "kode_pos" => "50231", "kode_kelurahan" => "3374091006
            "],
            ["id_kecamatan" => "3", "nama_kelurahan" => "Gajah Mungkur", "kode_pos" => "50232", "kode_kelurahan" => "3374091005
            "],
            ["id_kecamatan" => "3", "nama_kelurahan" => "Bendan Ngisor", "kode_pos" => "50233", "kode_kelurahan" => "3374091003
            "],
            ["id_kecamatan" => "3", "nama_kelurahan" => "Karang Rejo", "kode_pos" => "50234", "kode_kelurahan" => "3374091001
            "],
            ["id_kecamatan" => "3", "nama_kelurahan" => "Bendan Duwur", "kode_pos" => "50235", "kode_kelurahan" => "3374091002
            "],
            ["id_kecamatan" => "3", "nama_kelurahan" => "Sampangan", "kode_pos" => "50236", "kode_kelurahan" => "3374091004
            "],
            ["id_kecamatan" => "3", "nama_kelurahan" => "Petompon", "kode_pos" => "50237", "kode_kelurahan" => "3374091007
            "],
            ["id_kecamatan" => "4", "nama_kelurahan" => "Gayamsari", "kode_pos" => "50161", "kode_kelurahan" => "3374041007
            "],
            ["id_kecamatan" => "4", "nama_kelurahan" => "Siwalan", "kode_pos" => "50162", "kode_kelurahan" => "3374041005
            "],
            ["id_kecamatan" => "4", "nama_kelurahan" => "Sawah Besar", "kode_pos" => "50163", "kode_kelurahan" => "3374041003
            "],
            ["id_kecamatan" => "4", "nama_kelurahan" => "Kaligawe", "kode_pos" => "50164", "kode_kelurahan" => "3374041002
            "],
            ["id_kecamatan" => "4", "nama_kelurahan" => "Tambakrejo", "kode_pos" => "50165", "kode_kelurahan" => "3374041001
            "],
            ["id_kecamatan" => "4", "nama_kelurahan" => "Sambirejo", "kode_pos" => "50166", "kode_kelurahan" => "3374041004
            "],
            ["id_kecamatan" => "4", "nama_kelurahan" => "Pandean Lamper", "kode_pos" => "50167", "kode_kelurahan" => "3374041006
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Muktiharjo Lor", "kode_pos" => "50111", "kode_kelurahan" => "3374051009
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Terboyo Kulon", "kode_pos" => "50112", "kode_kelurahan" => "3374051012
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Terboyo Wetan", "kode_pos" => "50112", "kode_kelurahan" => "3374051013
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Penggaron Lor", "kode_pos" => "50113", "kode_kelurahan" => "3374051008
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Gebangsari", "kode_pos" => "50114", "kode_kelurahan" => "3374051006
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Bangetayu Kulon", "kode_pos" => "50115", "kode_kelurahan" => "3374051010
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Bangetayu Wetan", "kode_pos" => "50115", "kode_kelurahan" => "3374051011
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Kudu", "kode_pos" => "50116", "kode_kelurahan" => "3374051002
            "], ["id_kecamatan" => "5", "nama_kelurahan" => "Sembungharjo", "kode_pos" => "50116", "kode_kelurahan" => "3374051001
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Banjardowo", "kode_pos" => "50117", "kode_kelurahan" => "3374051005
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Karangroto", "kode_pos" => "50117", "kode_kelurahan" => "3374051003
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Trimulyo", "kode_pos" => "50118", "kode_kelurahan" => "3374051007
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Sukorejo", "kode_pos" => "50221", "kode_kelurahan" => "3374121010
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Kandri", "kode_pos" => "50222", "kode_kelurahan" => "3374121016
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Sadeng", "kode_pos" => "50222", "kode_kelurahan" => "3374121011
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Cepoko", "kode_pos" => "50223", "kode_kelurahan" => "3374121012
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Jatirejo", "kode_pos" => "50223", "kode_kelurahan" => "3374121013
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Nongkosawit", "kode_pos" => "50224", "kode_kelurahan" => "3374121005
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Plalangan", "kode_pos" => "50225", "kode_kelurahan" => "3374121003
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Sumurrejo", "kode_pos" => "50226", "kode_kelurahan" => "3374121014
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Mangunsari", "kode_pos" => "50227", "kode_kelurahan" => "3374121002
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Pakintelan", "kode_pos" => "50227", "kode_kelurahan" => "3374121001
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Ngijo", "kode_pos" => "50228", "kode_kelurahan" => "3374121007
            "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Patemon", "kode_pos" => "50228", "kode_kelurahan" => "3374121008
             "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Gunung Pati", "kode_pos" => "50225", "kode_kelurahan" => "3374121004
             "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Kalisegoro", "kode_pos" => "50229", "kode_kelurahan" => "3374121015
             "],
            ["id_kecamatan" => "6", "nama_kelurahan" => "Pongangan", "kode_pos" => "50224", "kode_kelurahan" => "3374121006
             "], ["id_kecamatan" => "6", "nama_kelurahan" => "Sekaran", "kode_pos" => "50229", "kode_kelurahan" => "3374121009
             "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Kedungpane", "kode_pos" => "50211", "kode_kelurahan" => "3374141010
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Pesantren", "kode_pos" => "50212", "kode_kelurahan" => "3374141014
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Ngadirgo", "kode_pos" => "50213", "kode_kelurahan" => "3374141011
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Wonoplumbon", "kode_pos" => "50214", "kode_kelurahan" => "3374141012
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Tambangan", "kode_pos" => "50215", "kode_kelurahan" => "3374141006
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Wonolopo", "kode_pos" => "50215", "kode_kelurahan" => "3374141007
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Bubakan", "kode_pos" => "50216", "kode_kelurahan" => "3374141002
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Cangkiran", "kode_pos" => "50216", "kode_kelurahan" => "3374141001
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Karangmalang", "kode_pos" => "50216", "kode_kelurahan" => "3374141003
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Polaman", "kode_pos" => "50217", "kode_kelurahan" => "3374141003
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Purwosari", "kode_pos" => "50217", "kode_kelurahan" => "3374141005
            "], ["id_kecamatan" => "7", "nama_kelurahan" => "Jatibarang", "kode_pos" => "50219", "kode_kelurahan" => "3374141009
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Jatisari", "kode_pos" => "50218", "kode_kelurahan" => "3374141013
            "],
            ["id_kecamatan" => "7", "nama_kelurahan" => "Mijen", "kode_pos" => "50218", "kode_kelurahan" => "3374141008
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Ngaliyan", "kode_pos" => "50181", "kode_kelurahan" => "3374151007
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Kalipancur", "kode_pos" => "50183", "kode_kelurahan" => "3374151005
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Purwoyoso", "kode_pos" => "50184", "kode_kelurahan" => "3374151004
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Tambakaji", "kode_pos" => "50185", "kode_kelurahan" => "3374151008
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Gondoriyo", "kode_pos" => "50187", "kode_kelurahan" => "3374151001
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Podorejo", "kode_pos" => "50187", "kode_kelurahan" => "3374151002
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Wates", "kode_pos" => "50188", "kode_kelurahan" => "3374151010
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Beringin", "kode_pos" => "50189", "kode_kelurahan" => "3374151003
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Bambankerep", "kode_pos" => "50182", "kode_kelurahan" => "3374151006
            "],
            ["id_kecamatan" => "8", "nama_kelurahan" => "Wonosari", "kode_pos" => "50186", "kode_kelurahan" => "3374151009
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Gemah", "kode_pos" => "50191", "kode_kelurahan" => "3374061007
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Pedurungan Kidul", "kode_pos" => "50192", "kode_kelurahan" => "3374061008
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Pedurungan Lor", "kode_pos" => "50192", "kode_kelurahan" => "3374061009
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Pedurungan Tengah", "kode_pos" => "50192", "kode_kelurahan" => "3374061010
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Penggaron Kidul", "kode_pos" => "50194", "kode_kelurahan" => "3374061001
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Tlogosari Kulon", "kode_pos" => "50196", "kode_kelurahan" => "3374061004
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Tlogosari Wetan", "kode_pos" => "50196", "kode_kelurahan" => "3374061004
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Muktiharjo Kidul", "kode_pos" => "50197", "kode_kelurahan" => "3374061005
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Kalicari", "kode_pos" => "50198", "kode_kelurahan" => "3374061012
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Plamongan Sari", "kode_pos" => "50193", "kode_kelurahan" => "3374061006
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Palebon", "kode_pos" => "50199", "kode_kelurahan" => "3374061011
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Bojongsalaman", "kode_pos" => "50141", "kode_kelurahan" => "3374131009
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Cabean", "kode_pos" => "50141", "kode_kelurahan" => "3374131011
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Krobokan", "kode_pos" => "50141", "kode_kelurahan" => "3374131013
            "], ["id_kecamatan" => "10", "nama_kelurahan" => "Tawangmas", "kode_pos" => "50144", "kode_kelurahan" => "3374131015
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Tawangsari", "kode_pos" => "50144", "kode_kelurahan" => "3374131014
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Kalibanteng Kulon", "kode_pos" => "50145", "kode_kelurahan" => "3374131005
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Krapyak", "kode_pos" => "50146", "kode_kelurahan" => "3374131003
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Manyaran", "kode_pos" => "50147", "kode_kelurahan" => "3374131002
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Bongsari", "kode_pos" => "50148", "kode_kelurahan" => "3374131008
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Ngemplak Simongan", "kode_pos" => "50148", "kode_kelurahan" => "3374131001
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Gisikdrono", "kode_pos" => "50149", "kode_kelurahan" => "3374131007
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Kalibanteng Kidul", "kode_pos" => "50149", "kode_kelurahan" => "3374131006
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Karangayu", "kode_pos" => "50142", "kode_kelurahan" => "3374131012
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Tambakharjo", "kode_pos" => "50145", "kode_kelurahan" => "3374131004
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Kembangarum", "kode_pos" => "50148", "kode_kelurahan" => "3374131016
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Pleburan", "kode_pos" => "50241", "kode_kelurahan" => "3374071005
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Peterongan", "kode_pos" => "50242", "kode_kelurahan" => "3374071007
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Wonodri", "kode_pos" => "50242", "kode_kelurahan" => "3374071006
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Randusari", "kode_pos" => "50244", "kode_kelurahan" => "3374071001
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Barusari", "kode_pos" => "50245", "kode_kelurahan" => "3374071003
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Bulustalan", "kode_pos" => "50246", "kode_kelurahan" => "3374071002
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Lamper Tengah", "kode_pos" => "50248", "kode_kelurahan" => "3374071010
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Lamper Kidul", "kode_pos" => "50249", "kode_kelurahan" => "3374071009
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Lamper Lor", "kode_pos" => "50249", "kode_kelurahan" => "3374071008
            "],
            ["id_kecamatan" => "11", "nama_kelurahan" => "Mugassari", "kode_pos" => "50244", "kode_kelurahan" => "3374071004
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Pendrikan Kidul", "kode_pos" => "50131", "kode_kelurahan" => "3374011014
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Pendrikan Lor", "kode_pos" => "50131", "kode_kelurahan" => "3374011015
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Sekayu", "kode_pos" => "50132", "kode_kelurahan" => "3374011007
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Kembangsari", "kode_pos" => "50133", "kode_kelurahan" => "3374011006
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Miroto", "kode_pos" => "50134", "kode_kelurahan" => "3374011001
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Brumbungan", "kode_pos" => "50135", "kode_kelurahan" => "3374011002
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Gabahan", "kode_pos" => "50135", "kode_kelurahan" => "3374011005
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Purwodinatan", "kode_pos" => "50137", "kode_kelurahan" => "3374011011
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Bangunharjo", "kode_pos" => "50138", "kode_kelurahan" => "3374011009
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Kranggan", "kode_pos" => "50137", "kode_kelurahan" => "3374011004
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Pandansari", "kode_pos" => "50139", "kode_kelurahan" => "3374011008
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Kauman", "kode_pos" => "50139", "kode_kelurahan" => "3374011010
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Karangkidul", "kode_pos" => "50136", "kode_kelurahan" => "3374011012
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Pekunden", "kode_pos" => "50134", "kode_kelurahan" => "3374011013
            "],
            ["id_kecamatan" => "12", "nama_kelurahan" => "Jagalan", "kode_pos" => "50613", "kode_kelurahan" => "3374011003
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Mlatibaru", "kode_pos" => "50122", "kode_kelurahan" => "3374031003
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Kebonagung", "kode_pos" => "50123", "kode_kelurahan" => "3374031004
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Karangturi", "kode_pos" => "50124", "kode_kelurahan" => "3374031009
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Sarirejo", "kode_pos" => "50124", "kode_kelurahan" => "3374031007
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Rejosari", "kode_pos" => "50125", "kode_kelurahan" => "3374031008
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Bugangan", "kode_pos" => "50126", "kode_kelurahan" => "3374031006
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Mlatiharjo", "kode_pos" => "50126", "kode_kelurahan" => "3374031005
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Rejomulyo", "kode_pos" => "50127", "kode_kelurahan" => "3374031002
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Kemijen", "kode_pos" => "50128", "kode_kelurahan" => "3374031001
            "],
            ["id_kecamatan" => "13", "nama_kelurahan" => "Karangtempel", "kode_pos" => "50125", "kode_kelurahan" => "3374031010
            "], ["id_kecamatan" => "14", "nama_kelurahan" => "Plombokan", "kode_pos" => "50171", "kode_kelurahan" => "3374021003
            "],
            ["id_kecamatan" => "14", "nama_kelurahan" => "Purwosari", "kode_pos" => "50172", "kode_kelurahan" => "3374021004
            "],
            ["id_kecamatan" => "14", "nama_kelurahan" => "Dadapsari", "kode_pos" => "50173", "kode_kelurahan" => "3374021009
            "],
            ["id_kecamatan" => "14", "nama_kelurahan" => "Tanjungmas", "kode_pos" => "50174", "kode_kelurahan" => "3374021008
            "],
            ["id_kecamatan" => "14", "nama_kelurahan" => "Bandarharjo", "kode_pos" => "50175", "kode_kelurahan" => "3374021001
            "],
            ["id_kecamatan" => "14", "nama_kelurahan" => "Kuningan", "kode_pos" => "50176", "kode_kelurahan" => "3374021005
            "],
            ["id_kecamatan" => "14", "nama_kelurahan" => "Panggung Lor", "kode_pos" => "50177", "kode_kelurahan" => "3374021006
            "],
            ["id_kecamatan" => "14", "nama_kelurahan" => "Panggung Kidul", "kode_pos" => "50178", "kode_kelurahan" => "3374021007
            "],
            ["id_kecamatan" => "14", "nama_kelurahan" => "Bulu Lor", "kode_pos" => "50179", "kode_kelurahan" => "3374021002
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Meteseh", "kode_pos" => "50271", "kode_kelurahan" => "3374101001
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Mangunharjo", "kode_pos" => "50272", "kode_kelurahan" => "3374101003
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Sendangmulyo", "kode_pos" => "50272", "kode_kelurahan" => "3374101011
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Kedungmundu", "kode_pos" => "50273", "kode_kelurahan" => "3374101009
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Sendangguwo", "kode_pos" => "50273", "kode_kelurahan" => "3374101010
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Jangli", "kode_pos" => "50274", "kode_kelurahan" => "3374101007
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Tandang", "kode_pos" => "50274", "kode_kelurahan" => "3374101008
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Tembalang", "kode_pos" => "50275", "kode_kelurahan" => "3374101006
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Sambiroto", "kode_pos" => "50276", "kode_kelurahan" => "3374101012
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Bulusan", "kode_pos" => "50277", "kode_kelurahan" => "3374101004
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Kramas", "kode_pos" => "50278", "kode_kelurahan" => "3374101005
            "],
            ["id_kecamatan" => "15", "nama_kelurahan" => "Rowosari", "kode_pos" => "50279", "kode_kelurahan" => "3374101002
            "],
            ["id_kecamatan" => "16", "nama_kelurahan" => "Jerakah", "kode_pos" => "50151", "kode_kelurahan" => "3374161001
            "],
            ["id_kecamatan" => "16", "nama_kelurahan" => "Karanganyar", "kode_pos" => "50152", "kode_kelurahan" => "3374161003
            "],
            ["id_kecamatan" => "16", "nama_kelurahan" => "Mangunharjo", "kode_pos" => "50154", "kode_kelurahan" => "3374161007
            "],
            ["id_kecamatan" => "16", "nama_kelurahan" => "Mangkang Kulon", "kode_pos" => "50155", "kode_kelurahan" => "3374161006
            "],
            ["id_kecamatan" => "16", "nama_kelurahan" => "Mangkang Wetan", "kode_pos" => "50156", "kode_kelurahan" => "3374161005
            "],
            ["id_kecamatan" => "16", "nama_kelurahan" => "Randu Garut", "kode_pos" => "50153", "kode_kelurahan" => "3374161004
            "],
            ["id_kecamatan" => "16", "nama_kelurahan" => "Tugurejo", "kode_pos" => "50151", "kode_kelurahan" => "3374161002
            "],
            ["id_kecamatan" => "5", "nama_kelurahan" => "Genuksari", "kode_pos" => "50117", "kode_kelurahan" => "3374051004
            "],
            ["id_kecamatan" => "9", "nama_kelurahan" => "Tlogomulyo", "kode_pos" => "50195", "kode_kelurahan" => "3374061002
            "],
            ["id_kecamatan" => "10", "nama_kelurahan" => "Salamanmloyo", "kode_pos" => "50143", "kode_kelurahan" => "3374131010
            "]
        ];
        foreach ($kelurahans as $kel) {
            Kelurahan::create($kel);
        }
    }
}