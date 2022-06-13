<?php

namespace App\Http\Controllers;

use App\CalonPendamping, App\User,App\SubKriteria, App\NilaiCalonPendamping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Validator;
use Hash;
use Session;

class CalonPendampingController extends Controller
{

    public function index()
    {
        return view('calonPendamping.index');
    }

    public function list()
    {
        $pendamping  = CalonPendamping::where('wawancara',0)->get();
        $pendampings = CalonPendamping::all();
        $sudah = CalonPendamping::where('validasi',1)->get()->count();
        $belum = CalonPendamping::where('validasi',0)->get()->count();
        $tidak = CalonPendamping::where('validasi',2)->get()->count();
        return view('pendamping.index',compact('pendampings','sudah','belum','tidak','pendamping'));
    }

    public function profile()
    {
        return view('calonPendamping.show');
    }

    public function gantiPassword()
    {
        return view('calonPendamping.password');
    }

    public function ganti(Request $r)
    {
        $user = User::find(Auth::user()->id);
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

    public function create()
    {
        //
    }

    public function store(Request $r)
    {
        if ($r->pendamping == "null") {
            return redirect()->back()->with('error', 'Data Yang Dimasukkan Tidak Valid');
        } 
    
        $pendamping = CalonPendamping::find($r->pendamping);
        $nilaiPendamping = NilaiCalonPendamping::where('id_pendamping',$r->pendamping)->first();

        if($r->tertulis < 5){
            $c4 = "K44";
        }elseif(($r->tertulis >= 5) && ($r->tertulis <= 6)){
            $c4 = "K43";
        }elseif(($r->tertulis >= 7) && ($r->tertulis <= 8)){
            $c4 = "K42";
        }elseif(($r->tertulis >= 9) && ($r->tertulis <= 10)){
            $c4 = "K41";
        }

        $c4 = Subkriteria::where('kode',$c4)->first('id')->id;
        $nilaiPendamping->c4 = $c4;
        $c5 = Subkriteria::where('kode',$r->wawancara)->first('id')->id;
        $nilaiPendamping->c5 = $c5;
        $nilaiPendamping->save();

        $pendamping->tes_tertulis = 1;
        $pendamping->wawancara = 1;
        $pendamping->save();

        $nama_lengkap = $pendamping->nama_depan.' '.$pendamping->nama_belakang;

        return redirect()->back()->with('sukses', 'Data Hasil Tes Calon Pendamping <strong>'.$nama_lengkap.'</strong> Telah Berhasil Diinput');
    }

    public function show($id)
    {
        $pendamping = CalonPendamping::find($id);
        return view('pendamping.show',compact('pendamping'));
    }

    public function kabarin($id,$kabar)
    {
        $pendamping = CalonPendamping::find($id);
        $pendamping->validasi = $kabar;
        $pendamping->save();
        $nama_lengkap = $pendamping->nama_depan.' '.$pendamping->nama_belakang;
        if ($kabar == 3) {
            return redirect()->back()->with('sukses', 'Pesan Telah Terkirim Ke Dashboard Pendamping <strong>'.$nama_lengkap.'</strong>');
        } else {
            return redirect()->back()->with('sukses', 'Pesan Telah Ditarik Dari Dashboard Pendamping <strong>'.$nama_lengkap.'</strong>');
        }
        
    }

    public function validasi(Request $r, $id)
    {
        $pendamping = CalonPendamping::find($id);
        $pendamping->validasi = $r->valid;
        $pendamping->save();
        return redirect()->route('admin.dashboard')->with('sukses','Data Berhasil Divalidasi');
    }

    public function edit(CalonPendamping $calonPendamping)
    {
        //
    }

    public function update(Request $r, $id)
    {
        $pendamping = CalonPendamping::find($id);
    
        $rules = [
            'nama_depan'           => 'required|max:25',
            'nama_belakang'        => 'required|max:50',
            'jenis_kelamin'        => 'required',
            'tanggal_lahir'        => 'required',
            'no_hp'                => 'required|numeric',
            'universitas'          => 'required',
            'jenjang'              => 'required',
            'alamat'               => 'required',
            'foto'                 => 'max:1024|mimes:jpg,png,jpeg',
            'ktp'                  => 'max:1024|mimes:pdf,jpg,png,jpeg',
            'kk'                   => 'max:1024|mimes:pdf,jpg,png,jpeg',
            'skck'                 => 'max:1024|mimes:pdf,jpg,png,jpeg',
            'akta_kelahiran'       => 'max:1024|mimes:pdf,jpg,png,jpeg',
            'ijazah'               => 'max:1024|mimes:pdf,jpg,png,jpeg',
        ];
 
        $messages = [
            'nama_depan.required'           => 'Nama Depan wajib diisi',
            'nama_depan.max'                => 'Nama Depan maksimal 50 karakter',
            'nama_belakang.required'        => 'Nama Belakang wajib diisi',
            'nama_belakang.max'             => 'Nama Belakang maksimal 50 karakter',
            'no_ktp.required'               => 'No KTP wajib diisi',
            'no_ktp.unique'                 => 'No KTP Sudah Terdaftar, Mohon input data yang valid',
            'no_ktp.min'                    => 'No KTP Minimal berjumlah 16 Digit',
            'tanggal_lahir.required'        => 'Tanggal Lahir wajib diisi',
            'email.required'                => 'Email wajib diisi',
            'email.unique'                => 'Email Tidak Boleh Sama, Sudah Terdapat Pengguna Yang Mendaftar Dengan Email Tersebut',
            'no_hp.required'                => 'Nomor Handphone wajib diisi',
            'no_hp.numeric'                 => 'Nomor Harus Berupa Angka',
            'alamat.required'               => 'Alamat wajib diisi',
            'foto.max'                      => 'File Foto melebihi batas maksimal, ukuran maksimal : 1Mb',
            'foto.mimes'                    => 'Format File Foto Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
            'ktp.max'                       => 'File KTP melebihi batas maksimal, ukuran maksimal : 1Mb',
            'ktp.mimes'                     => 'Format File Foto KTP Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'kk.required'                   => 'File KK Belum Diunggah',
            'kk.max'                        => 'File KK melebihi batas maksimal, ukuran maksimal : 1Mb',
            'kk.mimes'                      => 'Format File Foto KK Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'skck.max'                      => 'File SKCK melebihi batas maksimal, ukuran maksimal : 1Mb',
            'skck.mimes'                    => 'Format File Foto SKCK Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'akta_kelahiran.max'            => 'File Akta Kelahiran melebihi batas maksimal, ukuran maksimal : 1Mb',
            'akta_kelahiran.mimes'          => 'Format File Foto Akta Kelahiran Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'ijazah.max'                    => 'Ijazah melebihi batas maksimal, ukuran maksimal : 1Mb',
            'ijazah.mimes'                  => 'Format File Ijazah Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
        ];
 
        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }

        $years = Carbon::parse($r->tanggal_lahir)->age;
        
        if ($years < 17) {
            Session::flash('error', 'Umur Minimal 17 Tahun');
            return redirect()->back()->withInput();
        }

        $kk = $pendamping->kk;
        $ktp = $pendamping->ktp;
        $akta_kelahiran = $pendamping->akta_kelahiran;
        $ijazah = $pendamping->ijazah;
        $skck = $pendamping->skck;

        if ($r->foto != null) {
            $r->foto->store('pendamping/foto', 'public');
            $pendamping->foto = $r->foto->hashName();
        }
        
        if ($r->ktp != null) {
            $r->ktp->store('pendamping/foto_ktp', 'public');
            $pendamping->ktp = json_encode(['file' => $r->ktp->hashName(),'validasi' => 0,'Keterangan' => ""]);
            $ktp = $r->ktp;
        }
        
        if ($r->ijazah != null) {
            $r->ijazah->store('pendamping/ijazah', 'public');
            $pendamping->ijazah = json_encode(['file' => $r->ijazah->hashName(),'validasi' => 0,'Keterangan' => ""]);
            $ijazah = $r->ijazah;
        }
        
        if ($r->skck != null) {
            $r->skck->store('pendamping/foto_skck', 'public');
            $pendamping->skck = json_encode(['file' => $r->skck->hashName(),'validasi' => 0,'Keterangan' => ""]);
            $skck = $r->skck;
        }
        
        if ($r->kk != null) {
            $r->kk->store('pendamping/foto_kk', 'public');
            $pendamping->kk = json_encode(['file' => $r->kk->hashName(),'validasi' => 0,'Keterangan' => ""]);
            $kk = $r->kk;
        }
        
        if ($r->akta_kelahiran != null) {
            $r->akta_kelahiran->store('pendamping/akta_kelahiran', 'public');
            $pendamping->akta_kelahiran = json_encode(['file' => $r->akta_kelahiran->hashName(),'validasi' => 0,'Keterangan' => ""]);
            $akta_kelahiran = $r->$akta_kelahiran;
        }

        if(($kk != NULL) && ($ktp != NULL) && ($akta_kelahiran != NULL) && ($ijazah != NULL) && ($skck != NULL)){
            $c1 = "K11";
        }elseif(($kk != NULL) && ($ktp != NULL) && ($akta_kelahiran != NULL) && ($ijazah != NULL)){
            $c1 = "K12";
        }elseif(($kk != NULL) && ($ktp != NULL) && ($akta_kelahiran != NULL)){
            $c1 = "K13";
        }elseif(($kk != NULL) && ($ktp != NULL)){
            $c1 = "K14";
        }
        $c1 = Subkriteria::where('kode',$c1)->first()->id;

        if($r->jenjang == "S2/Sederajat"){
            $c2 = "K21";
        }elseif($r->jenjang == "S1/Sederajat"){
            $c2 = "K22";
        }elseif($r->jenjang == "D3/Sederajat"){
            $c2 = "K23";
        }elseif($r->jenjang == "SMA/SMK/Sederajat"){
            $c2 = "K24";
        }
        $c2 = Subkriteria::where('kode',$c2)->first()->id;

        if(($years >= 32)){
            $c3 = "K31";
        }elseif(($years >= 27) && ($years <= 31)){
            $c3 = "K32";
        }elseif(($years >= 22) && ($years <= 26)){
            $c3 = "K33";
        }elseif(($years >= 17) && ($years <= 21)){
            $c3 = "K34";
        }
        $c3 = Subkriteria::where('kode',$c3)->first()->id;

        $user = User::find($pendamping->id_user);
        $user->name = $r->nama_depan;
        $user->role = 2;
        $user->email = $r->email;
        $user->save();

        $pendamping->id_user = $user->id;
        $pendamping->no_ktp = $r->no_ktp;
        $pendamping->nama_depan = $r->nama_depan;
        $pendamping->nama_belakang = $r->nama_belakang;
        $pendamping->no_hp = $r->no_hp;
        $pendamping->tanggal_lahir = $r->tanggal_lahir;
        $pendamping->usia = $years;
        $pendamping->email = $r->email;
        $pendamping->universitas = $r->universitas;
        $pendamping->jenjang = $r->jenjang;
        $pendamping->jenis_kelamin = $r->jenis_kelamin;
        $pendamping->alamat = $r->alamat;
        $simpan = $pendamping->save();

        $nilaiPendamping = NilaiCalonPendamping::where('id_pendamping',$pendamping->id)->first();
        $nilaiPendamping->c1 = $c1;
        $nilaiPendamping->c2 = $c2;
        $nilaiPendamping->c3 = $c3;
        $nilaiPendamping->save();
    
            $nama_lengkap = $r->nama_depan.' '.$r->nama_belakang;
        if($simpan){
            return redirect()->back()->with('sukses','Data '.$nama_lengkap.' Berhasil Diperbarui');
        } else {
            Session::flash('errors', ['' => 'Data Gagal Ditambahkan! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $pendamping = CalonPendamping::find($id);
        $pengguna   = User::find($pendamping->id_user);
        $pendamping->delete();
        $pengguna->delete();
        return redirect()->back()->with('sukses','Data Berhasil Dihapus');
    }

    public function daftar()
    {
        return view('calonPendamping.register');
    }

    public function kirim(Request $r)
    {
        $rules = [
            'nama_depan'           => 'required|max:25',
            'nama_belakang'        => 'required|max:50',
            'no_ktp'               => 'required|numeric|min:16|unique:calon_pendampings,no_ktp',
            'jenis_kelamin'        => 'required',
            'tanggal_lahir'        => 'required',
            'email'                => 'required|unique:users,email',
            'no_hp'                => 'required|numeric',
            'universitas'          => 'required',
            'jenjang'              => 'required',
            'alamat'               => 'required',
            'foto'                 => 'required|max:1024|mimes:jpg,png,jpeg',
            'ktp'                  => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'kk'                   => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'skck'                 => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'akta_kelahiran'       => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'ijazah'               => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
        ];
 
        $messages = [
            'nama_depan.required'           => 'Nama Depan wajib diisi',
            'nama_depan.max'                => 'Nama Depan maksimal 50 karakter',
            'nama_belakang.required'        => 'Nama Belakang wajib diisi',
            'nama_belakang.max'             => 'Nama Belakang maksimal 50 karakter',
            'no_ktp.required'               => 'No KTP wajib diisi',
            'no_ktp.unique'                 => 'No KTP Sudah Terdaftar, Mohon input data yang valid',
            'no_ktp.min'                    => 'No KTP Minimal berjumlah 16 Digit',
            'tanggal_lahir.required'        => 'Tanggal Lahir wajib diisi',
            'email.required'                => 'Email wajib diisi',
            'email.unique'                => 'Email Tidak Boleh Sama, Sudah Terdapat Pengguna Yang Mendaftar Dengan Email Tersebut',
            'no_hp.required'                => 'Nomor Handphone wajib diisi',
            'no_hp.numeric'                 => 'Nomor Harus Berupa Angka',
            'alamat.required'               => 'Alamat wajib diisi',
            'foto.required'                 => 'Foto Belum Diunggah',
            'foto.max'                      => 'File Foto melebihi batas maksimal, ukuran maksimal : 1Mb',
            'foto.mimes'                    => 'Format File Foto Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
            'ktp.required'                  => 'File KTP Belum Diunggah',
            'ktp.max'                       => 'File KTP melebihi batas maksimal, ukuran maksimal : 1Mb',
            'ktp.mimes'                     => 'Format File Foto KTP Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'kk.required'                   => 'File KK Belum Diunggah',
            'kk.max'                        => 'File KK melebihi batas maksimal, ukuran maksimal : 1Mb',
            'kk.mimes'                      => 'Format File Foto KK Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'skck.required'                 => 'File SKCK Belum Diunggah',
            'skck.max'                      => 'File SKCK melebihi batas maksimal, ukuran maksimal : 1Mb',
            'skck.mimes'                    => 'Format File Foto SKCK Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'akta_kelahiran.required'       => 'File Akta Kelahiran Belum Diunggah',
            'akta_kelahiran.max'            => 'File Akta Kelahiran melebihi batas maksimal, ukuran maksimal : 1Mb',
            'akta_kelahiran.mimes'          => 'Format File Foto Akta Kelahiran Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'ijazah.required'               => 'Ijazah Belum Diunggah',
            'ijazah.max'                    => 'Ijazah melebihi batas maksimal, ukuran maksimal : 1Mb',
            'ijazah.mimes'                  => 'Format File Ijazah Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
        ];
 
        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }

        $years = Carbon::parse($r->tanggal_lahir)->age;
        
        if ($years < 17) {
            Session::flash('error', 'Umur Minimal 17 Tahun');
            return redirect()->back()->withInput();
        }

        if(($r->kk != NULL) && ($r->ktp != NULL) && ($r->akta_kelahiran != NULL) && ($r->ijazah != NULL) && ($r->skck != NULL)){
            $c1 = "K11";
        }elseif(($r->kk != NULL) && ($r->ktp != NULL) && ($r->akta_kelahiran != NULL) && ($r->ijazah != NULL)){
            $c1 = "K12";
        }elseif(($r->kk != NULL) && ($r->ktp != NULL) && ($r->akta_kelahiran != NULL)){
            $c1 = "K13";
        }elseif(($r->kk != NULL) && ($r->ktp != NULL)){
            $c1 = "K14";
        }
        $c1 = Subkriteria::where('kode',$c1)->first()->id;

        if($r->jenjang == "S2/Sederajat"){
            $c2 = "K21";
        }elseif($r->jenjang == "S1/Sederajat"){
            $c2 = "K22";
        }elseif($r->jenjang == "D3/Sederajat"){
            $c2 = "K23";
        }elseif($r->jenjang == "SMA/SMK/Sederajat"){
            $c2 = "K24";
        }
        $c2 = Subkriteria::where('kode',$c2)->first()->id;

        if(($years >= 32)){
            $c3 = "K31";
        }elseif(($years >= 27) && ($years <= 31)){
            $c3 = "K32";
        }elseif(($years >= 22) && ($years <= 26)){
            $c3 = "K33";
        }elseif(($years >= 17) && ($years <= 21)){
            $c3 = "K34";
        }
        $c3 = Subkriteria::where('kode',$c3)->first()->id;

        $r->foto->store('pendamping/foto', 'public');
        $r->ktp->store('pendamping/foto_ktp', 'public');
        $r->kk->store('pendamping/foto_kk', 'public');
        $r->skck->store('pendamping/foto_skck', 'public');
        $r->akta_kelahiran->store('pendamping/akta_kelahiran', 'public');
        $r->ijazah->store('pendamping/ijazah', 'public');

        $user = new User;
        $user->name = $r->nama_depan;
        $user->role = 2;
        $user->email = $r->email;
        $user->password = bcrypt('password');
        $user->save();

        $pendamping = new CalonPendamping;
        $pendamping->id_user = $user->id;
        $pendamping->no_ktp = $r->no_ktp;
        $pendamping->nama_depan = $r->nama_depan;
        $pendamping->nama_belakang = $r->nama_belakang;
        $pendamping->no_hp = $r->no_hp;
        $pendamping->tanggal_lahir = $r->tanggal_lahir;
        $pendamping->usia = $years;
        $pendamping->email = $r->email;
        $pendamping->universitas = $r->universitas;
        $pendamping->jenjang = $r->jenjang;
        $pendamping->jenis_kelamin = $r->jenis_kelamin;
        $pendamping->alamat = $r->alamat;
        $pendamping->foto = $r->foto->hashName();
        $pendamping->ktp = json_encode(['file' => $r->ktp->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pendamping->kk = json_encode(['file' => $r->kk->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pendamping->skck = json_encode(['file' => $r->skck->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pendamping->akta_kelahiran = json_encode(['file' => $r->akta_kelahiran->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pendamping->ijazah = json_encode(['file' => $r->ijazah->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pendamping->validasi     = 0;
        $pendamping->tes_tertulis = 0;
        $pendamping->wawancara    = 0;
        $simpan = $pendamping->save();

        $nilaiPendamping = new NilaiCalonPendamping;
        $nilaiPendamping->id_pendamping = $pendamping->id;
        $nilaiPendamping->c1 = $c1;
        $nilaiPendamping->c2 = $c2;
        $nilaiPendamping->c3 = $c3;
        $nilaiPendamping->save();
    
            $nama_lengkap = $r->nama_depan.' '.$r->nama_belakang;
        if($simpan){
            return redirect()->back()->with('sukses', $nama_lengkap);
        } else {
            Session::flash('errors', ['' => 'Data Gagal Ditambahkan! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back();
        }
    }
}
