<?php

namespace App\Http\Controllers;

use App\CalonPendamping, App\User,App\Subkriteria, App\NilaiCalonPendamping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Validator;
use Hash;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
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
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('sukses','Data Berhasil Dihapus');
    }

    public function ganti(Request $r,$id)
    {
        $user = User::find($id);
        $rules = [
            'password' => 'required',
            'baru'     => 'required'
        ];

        $messages = [
            'password.required'     => 'Password terdahulu wajib diisi',
            'baru.required'         => 'Password Baru Wajib Diisi'
        ];

        $validator = Validator::make($r->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }

        if(Hash::check($r->password,$user->password)) {
            $user->update([
                'password' => Hash::make($r->baru),
            ]);

            return redirect()->back()->with('sukses', 'Password Berhasil Diperbarui!');
        } else {
            return redirect()->back()->withErrors('Password Lama Tidak Sesuai! Coba Lagi');
        }
    }
}
