<?php

namespace App\Http\Controllers;

use App\CalonPaskibraka, App\User,App\SubKriteria, App\NilaiCalonPaskibraka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Validator;
use Hash;
use Session;

class CalonPaskibrakaController extends Controller
{
    public function kirim(Request $r)
    {
        $rules = [
            'nisn'                 => 'required|numeric|unique:calon_paskibrakas,nisn',
            'nama_depan'           => 'required|max:25',
            'nama_belakang'        => 'required|max:50',
            'no_hp'                => 'required|numeric',
            'tanggal_lahir'        => 'required',
            'email'                => 'required|unique:users,email',
            'asal_sekolah'         => 'required',
            'alamat_sekolah'       => 'required',
            'jenis_kelamin'        => 'required',
            'alamat'               => 'required',
            'foto_calon_anggota'   => 'required|max:1024|mimes:jpg,png,jpeg',
            'tinggi_badan'         => 'required',
            'berat_badan'          => 'required',
            'surat_pernyataan'     => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'surat_pengantar_kepsek' => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'scan_nilai_rapor'      => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'foto_kartu_pelajar'   => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'sttb_sltp'            => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'surat_izin_orang_tua' => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
        ];
 
        $messages = [
            'nama_depan.required'             => 'Nama Depan wajib diisi',
            'nama_depan.max'                  => 'Nama Depan maksimal 50 karakter',
            'nama_belakang.required'          => 'Nama Belakang wajib diisi',
            'nama_belakang.max'               => 'Nama Belakang maksimal 50 karakter',
            'nisn.required'                   => 'No KTP wajib diisi',
            'nisn.unique'                     => 'No KTP Sudah Terdaftar, Mohon input data yang valid',
            'nisn.min'                        => 'No KTP Minimal berjumlah 16 Digit',
            'tanggal_lahir.required'          => 'Tanggal Lahir wajib diisi',
            'email.required'                  => 'Email wajib diisi',
            'email.unique'                    => 'Email Tidak Boleh Sama, Sudah Terdapat Pengguna Yang Mendaftar Dengan Email Tersebut',
            'no_hp.required'                  => 'Nomor Handphone wajib diisi',
            'no_hp.numeric'                   => 'Nomor Harus Berupa Angka',
            'alamat.required'                 => 'Alamat wajib diisi',
            'foto_calon_anggota.required'     => 'Foto Calon Anggota Belum Diunggah',
            'foto_calon_anggota.max'          => 'File Foto melebihi batas maksimal, ukuran maksimal : 1Mb',
            'foto_calon_anggota.mimes'        => 'Format File Foto Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
            'surat_pernyataan.required'       => 'Surat Pernyataan Belum Diunggah',
            'surat_pernyataan.max'            => 'File Surat Pernyataan melebihi batas maksimal, ukuran maksimal : 1Mb',
            'surat_pernyataan.mimes'          => 'Format File Surat Pernyataan Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
            'surat_pengantar_kepsek.required' => 'Surat Pengantar Belum Diunggah',
            'surat_pengantar_kepsek.max'      => 'File Surat Pengantar melebihi batas maksimal, ukuran maksimal : 1Mb',
            'surat_pengantar_kepsek.mimes'    => 'Format File Surat Pengantar Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
            'scan_nilai_rapor.required'       => 'Scan Nilai Rapor Belum Diunggah',
            'scan_nilai_rapor.max'            => 'File Scan Nilai Rapor melebihi batas maksimal, ukuran maksimal : 1Mb',
            'scan_nilai_rapor.mimes'          => 'Format File Scan Nilai Rapor Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
            'foto_kartu_pelajar.required'     => 'Foto Kartu Pelajar Belum Diunggah',
            'foto_kartu_pelajar.max'          => 'File Foto Kartu Pelajar melebihi batas maksimal, ukuran maksimal : 1Mb',
            'foto_kartu_pelajar.mimes'        => 'Format File Foto Kartu Pelajar Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
            'sttb_sltp.required'              => 'STTB SLTP Belum Diunggah',
            'sttb_sltp.max'                   => 'File STTB SLTP melebihi batas maksimal, ukuran maksimal : 1Mb',
            'sttb_sltp.mimes'                 => 'Format File STTB SLTP Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
            'surat_izin_orang_tua.required'   => 'Surat Izin Orang Tua Belum Diunggah',
            'surat_izin_orang_tua.max'        => 'File Surat Izin Orang Tua melebihi batas maksimal, ukuran maksimal : 1Mb',
            'surat_izin_orang_tua.mimes'      => 'Format File Surat Izin Orang Tua Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
        ];
 
        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }

        $years = Carbon::parse($r->tanggal_lahir)->age;
        
        $r->foto_calon_anggota->store('paskibraka/foto_calon_anggota', 'public');
        $r->surat_pernyataan->store('paskibraka/surat_pernyataan', 'public');
        $r->surat_pengantar_kepsek->store('paskibraka/surat_pengantar_kepsek', 'public');
        $r->scan_nilai_rapor->store('paskibraka/scan_nilai_rapor', 'public');
        $r->foto_kartu_pelajar->store('paskibraka/foto_kartu_pelajar', 'public');
        $r->sttb_sltp->store('paskibraka/sttb_sltp', 'public');
        $r->surat_izin_orang_tua->store('paskibraka/surat_izin_orang_tua', 'public');

        $user = new User;
        $user->name = $r->nama_depan;
        $user->role = 2;
        $user->email = $r->email;
        $user->password = bcrypt('password');
        $user->save();

        $paskibraka = new CalonPaskibraka();
        $paskibraka->user_id = $user->id;
        $paskibraka->nisn = $r->nisn;
        $paskibraka->nama_depan = $r->nama_depan;
        $paskibraka->nama_belakang = $r->nama_belakang;
        $paskibraka->no_hp = $r->no_hp;
        $paskibraka->tanggal_lahir = $r->tanggal_lahir;
        $paskibraka->email = $r->email;
        $paskibraka->asal_sekolah = $r->asal_sekolah;
        $paskibraka->alamat_sekolah = $r->alamat_sekolah;
        $paskibraka->jenis_kelamin = $r->jenis_kelamin;
        $paskibraka->alamat = $r->alamat;
        $paskibraka->tinggi_badan = $r->tinggi_badan;
        $paskibraka->berat_badan = $r->berat_badan;
        $paskibraka->foto_calon_anggota = $r->foto_calon_anggota->hashName();
        $paskibraka->surat_pernyataan = json_encode(['file' => $r->surat_pernyataan->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $paskibraka->surat_pengantar_kepsek = json_encode(['file' => $r->surat_pengantar_kepsek->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $paskibraka->scan_nilai_rapor = json_encode(['file' => $r->scan_nilai_rapor->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $paskibraka->foto_kartu_pelajar = json_encode(['file' => $r->foto_kartu_pelajar->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $paskibraka->sttb_sltp = json_encode(['file' => $r->sttb_sltp->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $paskibraka->surat_izin_orang_tua = json_encode(['file' => $r->surat_izin_orang_tua->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $paskibraka->validasi     = 0;
        $simpan = $paskibraka->save();
    
            $nama_lengkap = $r->nama_depan.' '.$r->nama_belakang;
        if($simpan){
            return redirect()->back()->with('sukses', $nama_lengkap);
        } else {
            Session::flash('errors', ['' => 'Data Gagal Ditambahkan! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back();
        }
    }

    public function list()
    {
        $paskibraka  = CalonPaskibraka::where('tes_fisik',0)->get();
        $paskibrakas = CalonPaskibraka::all();
        $sudah = CalonPaskibraka::where('validasi',1)->get()->count();
        $belum = CalonPaskibraka::where('validasi',0)->get()->count();
        $tidak = CalonPaskibraka::where('validasi',2)->get()->count();
        return view('paskibraka.index',compact('paskibrakas','sudah','belum','tidak','paskibraka'));
    }

    public function show($id)
    {
        $paskibraka = CalonPaskibraka::find($id);
        return view('paskibraka.show',compact('paskibraka'));
    }

    public function validasi(Request $r, $id)
    {
        $paskibraka = CalonPaskibraka::find($id);
        $paskibraka->validasi = $r->valid;
        $paskibraka->save();
        return redirect()->route('admin.dashboard')->with('sukses','Data Berhasil Divalidasi');
    }

    public function destroy($id)
    {
        $paskibraka = CalonPaskibraka::find($id);
        $pengguna   = User::find($paskibraka->user_id);
        $paskibraka->delete();
        $pengguna->delete();
        return redirect()->back()->with('sukses','Data Berhasil Dihapus');
    }

    public function store(Request $r)
    {
        if ($r->paskibraka == "null") {
            return redirect()->back()->with('error', 'Data Yang Dimasukkan Tidak Valid');
        } 
    
        $paskibraka = CalonPaskibraka::find($r->paskibraka);

        // Tinggi Badan
        if ($paskibraka->jenis_kelamin == 1) {
            if($paskibraka->tinggi_badan > 180){
                $subKriterias = SubKriteria::where('kode', 'C11')->where('tipe',$paskibraka->jenis_kelamin)->first();
            } elseif (($paskibraka->tinggi_badan > 175) && ($paskibraka->tinggi_badan < 180)) {
                $subKriterias = SubKriteria::where('kode', 'C12')->where('tipe',$paskibraka->jenis_kelamin)->first();
            } elseif (($paskibraka->tinggi_badan > 170) && ($paskibraka->tinggi_badan < 176)) {
                $subKriterias = SubKriteria::where('kode', 'C13')->where('tipe',$paskibraka->jenis_kelamin)->first();
            } elseif ($paskibraka->tinggi_badan < 171) {
                $subKriterias = SubKriteria::where('kode', 'C14')->where('tipe',$paskibraka->jenis_kelamin)->first();
            }
        } else {
            if($paskibraka->tinggi_badan > 170){
                $subKriterias = SubKriteria::where('kode', 'C11')->where('tipe',$paskibraka->jenis_kelamin)->first();
            } elseif (($paskibraka->tinggi_badan > 165) && ($paskibraka->tinggi_badan < 170)) {
                $subKriterias = SubKriteria::where('kode', 'C12')->where('tipe',$paskibraka->jenis_kelamin)->first();
            } elseif (($paskibraka->tinggi_badan > 160) && ($paskibraka->tinggi_badan < 164)) {
                $subKriterias = SubKriteria::where('kode', 'C13')->where('tipe',$paskibraka->jenis_kelamin)->first();
            } elseif ($paskibraka->tinggi_badan < 160) {
                $subKriterias = SubKriteria::where('kode', 'C14')->where('tipe',$paskibraka->jenis_kelamin)->first();
            }
        }

        NilaiCalonPaskibraka::create([
            'paskibraka_id'   => $paskibraka->id,
            'tipe'            => $paskibraka->jenis_kelamin,
            'sub_kriteria_id' => $subKriterias->id
        ]);

        // BMI
        $tinggi = $paskibraka->tinggi_badan / 100;
        $tinggi = $tinggi * $tinggi;
        $bmi = $paskibraka->berat_badan / $tinggi; 
        if($bmi > 18.4 && $bmi < 23){
            $subKriterias = SubKriteria::where('kode', 'C21')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } else {
            $subKriterias = SubKriteria::where('kode', 'C22')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } 

        NilaiCalonPaskibraka::create([
            'paskibraka_id'   => $paskibraka->id,
            'tipe'            => $paskibraka->jenis_kelamin,
            'sub_kriteria_id' => $subKriterias->id
        ]);

        $fisik = 0;
        // Ketahanan Fisik
        if ($r->push_up > 30) {
            $fisik = $fisik + 1;
        }
        if ($r->sit_up > 30) {
            $fisik = $fisik + 1;
        }
        if ($r->pull_up > 30) {
            $fisik = $fisik + 1;
        }
        if ($r->squat_jump > 30) {
            $fisik = $fisik + 1;
        }
        if ($r->lari > 2) {
            $fisik = $fisik + 1;
        }
        
        if($fisik > 3){
            $subKriterias = SubKriteria::where('kode', 'C31')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } elseif ($fisik == 3) {
            $subKriterias = SubKriteria::where('kode', 'C32')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } elseif ($fisik == 2) {
            $subKriterias = SubKriteria::where('kode', 'C33')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } elseif ($fisik == 1) {
            $subKriterias = SubKriteria::where('kode', 'C34')->where('tipe',$paskibraka->jenis_kelamin)->first();
        }
        NilaiCalonPaskibraka::create([
            'paskibraka_id'   => $paskibraka->id,
            'tipe'            => $paskibraka->jenis_kelamin,
            'sub_kriteria_id' => $subKriterias->id
        ]);

        // Skor Pelatihan baris - ber baris
        if($r->skor_pelatihan_baris_ber_baris > 79){
            $subKriterias = SubKriteria::where('kode', 'C41')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } elseif (($r->skor_pelatihan_baris_ber_baris > 59) && ($r->skor_pelatihan_baris_ber_baris < 80)) {
            $subKriterias = SubKriteria::where('kode', 'C42')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } elseif (($r->skor_pelatihan_baris_ber_baris > 39) && ($r->skor_pelatihan_baris_ber_baris < 60)) {
            $subKriterias = SubKriteria::where('kode', 'C43')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } elseif ($r->skor_pelatihan_baris_ber_baris < 40) {
            $subKriterias = SubKriteria::where('kode', 'C44')->where('tipe',$paskibraka->jenis_kelamin)->first();
        }
        NilaiCalonPaskibraka::create([
            'paskibraka_id'   => $paskibraka->id,
            'tipe'            => $paskibraka->jenis_kelamin,
            'sub_kriteria_id' => $subKriterias->id
        ]);

        // Skor Tes Psikologi
        if($r->skor_pelatihan_baris_ber_baris == 5){
            $subKriterias = SubKriteria::where('kode', 'C51')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } elseif ($r->skor_pelatihan_baris_ber_baris == 4) {
            $subKriterias = SubKriteria::where('kode', 'C52')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } elseif ($r->skor_pelatihan_baris_ber_baris == 3) {
            $subKriterias = SubKriteria::where('kode', 'C53')->where('tipe',$paskibraka->jenis_kelamin)->first();
        } elseif ($r->skor_pelatihan_baris_ber_baris == 2) {
            $subKriterias = SubKriteria::where('kode', 'C54')->where('tipe',$paskibraka->jenis_kelamin)->first();
        }
        NilaiCalonPaskibraka::create([
            'paskibraka_id'   => $paskibraka->id,
            'tipe'            => $paskibraka->jenis_kelamin,
            'sub_kriteria_id' => $subKriterias->id
        ]);

        $paskibraka->tes_fisik = 1;
        $paskibraka->save();

        $nama_lengkap = $paskibraka->nama_depan.' '.$paskibraka->nama_belakang;

        return redirect()->back()->with('sukses', 'Data Hasil Tes Calon Paskibraka <strong>'.$nama_lengkap.'</strong> Telah Berhasil Diinput');
    }

}
