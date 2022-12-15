<?php

namespace App\Http\Controllers\Faskes;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faskes = User::where('kode_faskes', '=', Auth::user()->kode_faskes)->with(['detail_faskes'])->firstOrFail();
        $lokasi = json_decode($faskes->detail_faskes->koordinat);
        if ($lokasi != null) {
            $position = [
                [
                    'lat' => $lokasi[0],
                    'lng' => $lokasi[1],
                    'nama' => $faskes->detail_faskes->nama_faskes,
                ]
            ];
            $center =
                [
                    'lat' => (float)$lokasi[0],
                    'lng' => (float)$lokasi[1],
                ];
        } else {
            $position = [


                [
                    'lat' => -6.990147255992828,
                    'lng' => 110.4229720275933,
                    'nama' => $faskes->detail_faskes->nama_faskes,
                ]
            ];
            $center =
                [
                    'lat' => (float)-6.990147255992828,
                    'lng' => (float)110.4229720275933,
                ];
        }
        return view(
            'pages.faskes.klinik.profile.index',
            [
                'faskes' => $faskes,
                'faskes_lokasi' => $position,
                'center' => $center
            ]
        );
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
        $name = Auth::user()->name;
        // $arr = explode(' ', trim($name));
        $item = User::findOrFail(Crypt::decrypt($id));
        if (Storage::disk('local')->exists('public/' . $item->foto_profil)) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email:rfc,dns|max:255|unique:users,email,' . $item->id,
                'imageprofile' => 'image|mimes:jpeg,jpg,png|max:3072'
            ], [
                'email.required' => 'Alamat Email wajib diisi',
                'email.email' => 'Email harus merupakan alamat email yang valid',
                'email.unique' => 'Email sudah digunakan',
                'imageprofile.mimes' => 'Foto Profil harus berformat jpeg,jpg,png',
                'imageprofile.image' => 'Foto Profil harus berupa gambar',
                'imageprofile.max' => 'Foto Profil maksimal berukuran 3MB',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email:rfc,dns|max:255|unique:users,email,' . $item->id,
                'imageprofile' => 'required|image|mimes:jpeg,jpg,png|max:3072'
            ], [
                'email.required' => 'Alamat Email wajib diisi',
                'email.email' => 'Email harus merupakan alamat email yang valid',
                'email.unique' => 'Email sudah digunakan',
                'imageprofile.required' => 'Foto Profil wajib diisi',
                'imageprofile.image' => 'Foto Profil harus berupa gambar',
                'imageprofile.mimes' => 'Foto Profil harus berformat jpeg,jpg,png',
                'imageprofile.max' => 'Foto Profil maksimal berukuran 3MB',
            ]);
        }
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->getMessageBag()->all()[0])->withInput();
        } else {
            if (!empty($request->file('imageprofile'))) {
                $file = $request->file('imageprofile');
                $filename = str_replace(' ', '_', $name) . '_' . Carbon::now()->format('d-m-y') . '_' . time() . '.' . $file->getClientOriginalExtension();
                $img = Image::make($file);
                if (Image::make($file)->width() > 720) {
                    $img->resize(720, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $img->save(public_path('storage/assets/upload/profile/') . $filename);
                $image = 'assets/upload/profile/' . $img->basename;
                try {
                    Storage::disk('local')->delete('public/' . $item->foto_profil);
                } catch (\Throwable $th) {
                    return $th->getMessage();
                }
            } else {
                $image = $item->foto_profil;
            }
            $data = [
                'email' => $request->email,
                'foto_profil' => $image,
                'email_verified_at' => $request->email == $item->email ? $item->email_verified_at : null,
            ];
            $item->update($data);
            return redirect()->back()->withSuccess('Profile Faskes' . Auth::user()->name . ' diupdate!');
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
        //
    }
}