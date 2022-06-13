<?php

namespace App\Http\Controllers;

use PDF;
use App\Kriteria;
use App\CalonPendamping;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    private static $kriterias,$pendamping,$pendampings,$normalisasi,$optimasi,$Yi,$hasil,$optimasi_l;

    public function normalisasi($variable,$f) {
        $item = 0;
        foreach ($variable as $p) {
            $pangkat = pow($p->relasis[0]->$f->nilai, 2);
            $item = $item + $pangkat;
        }
        return sqrt($item);
    }

    public function perhitungan_moora(){
        self::$kriterias = Kriteria::all();
        self::$pendampings = CalonPendamping::where('wawancara',1)->get();
        $pendamping = CalonPendamping::where('wawancara',1)->get();
        //Tahap Normalisasi
        self::$normalisasi = collect(self::$pendampings)->map(function($pendampings, $key) use ($pendamping) {
            $collect = (object)$pendampings;
            return [
                 'id' => $collect->relasis[0]->pendamping->id,
                 'foto' => $collect->relasis[0]->pendamping->foto,
                 'no_ktp' => $collect->relasis[0]->pendamping->no_ktp,
                 'no_hp' => $collect->relasis[0]->pendamping->no_hp,
                 'email' => $collect->relasis[0]->pendamping->email,
                 'alamat' => $collect->relasis[0]->pendamping->alamat,
                 'validasi' => $collect->relasis[0]->pendamping->validasi,
                 'nama' => $collect->relasis[0]->pendamping->nama_depan.' '.$collect->relasis[0]->pendamping->nama_belakang,
                 'C1' => number_format($collect->relasis[0]->c1->nilai / $this->normalisasi($pendamping,'c1'),3),
                 'C2' => number_format($collect->relasis[0]->c2->nilai / $this->normalisasi($pendamping,'c2'),3),
                 'C3' => number_format($collect->relasis[0]->c3->nilai / $this->normalisasi($pendamping,'c3'),3),
                 'C4' => number_format($collect->relasis[0]->c4->nilai / $this->normalisasi($pendamping,'c4'),3),
                 'C5' => number_format($collect->relasis[0]->c5->nilai / $this->normalisasi($pendamping,'c5'),3),
            ];
        });

        self::$optimasi_l = collect(self::$pendampings)->map(function($pendampings, $key) use ($pendamping) {
            $collect = (object)$pendampings;
            return [
                 'id' => $collect->relasis[0]->pendamping->id,
                 'foto' => $collect->relasis[0]->pendamping->foto,
                 'no_ktp' => $collect->relasis[0]->pendamping->no_ktp,
                 'no_hp' => $collect->relasis[0]->pendamping->no_hp,
                 'email' => $collect->relasis[0]->pendamping->email,
                 'alamat' => $collect->relasis[0]->pendamping->alamat,
                 'validasi' => $collect->relasis[0]->pendamping->validasi,
                 'nama' => $collect->relasis[0]->pendamping->nama_depan.' '.$collect->relasis[0]->pendamping->nama_belakang,
                 'C1' => number_format($collect->relasis[0]->c1->nilai / $this->normalisasi($pendamping,'c1'),3)." * ".$pendamping[0]->relasis[0]->c1->kriteria->bobot,
                 'C2' => number_format($collect->relasis[0]->c2->nilai / $this->normalisasi($pendamping,'c2'),3)." * ".$pendamping[0]->relasis[0]->c2->kriteria->bobot,
                 'C3' => number_format($collect->relasis[0]->c3->nilai / $this->normalisasi($pendamping,'c3'),3)." * ".$pendamping[0]->relasis[0]->c3->kriteria->bobot,
                 'C4' => number_format($collect->relasis[0]->c4->nilai / $this->normalisasi($pendamping,'c4'),3)." * ".$pendamping[0]->relasis[0]->c4->kriteria->bobot,
                 'C5' => number_format($collect->relasis[0]->c5->nilai / $this->normalisasi($pendamping,'c5'),3)." * ".$pendamping[0]->relasis[0]->c5->kriteria->bobot,
            ];
        });

        // Tahap Optimasi
        self::$optimasi = collect(self::$pendampings)->map(function($pendampings, $key) use ($pendamping) {
            $collect = (object)$pendampings;
            return [
                 'id' => $collect->relasis[0]->pendamping->id,
                 'foto' => $collect->relasis[0]->pendamping->foto,
                 'no_ktp' => $collect->relasis[0]->pendamping->no_ktp,
                 'no_hp' => $collect->relasis[0]->pendamping->no_hp,
                 'email' => $collect->relasis[0]->pendamping->email,
                 'alamat' => $collect->relasis[0]->pendamping->alamat,
                 'validasi' => $collect->relasis[0]->pendamping->validasi,
                 'nama' => $collect->relasis[0]->pendamping->nama_depan.' '.$collect->relasis[0]->pendamping->nama_belakang,
                 'C1' => number_format($collect->relasis[0]->c1->nilai / $this->normalisasi($pendamping,'c1'),3) * $pendamping[0]->relasis[0]->c1->kriteria->bobot,
                 'C2' => number_format($collect->relasis[0]->c2->nilai / $this->normalisasi($pendamping,'c2'),3) * $pendamping[0]->relasis[0]->c2->kriteria->bobot,
                 'C3' => number_format($collect->relasis[0]->c3->nilai / $this->normalisasi($pendamping,'c3'),3) * $pendamping[0]->relasis[0]->c3->kriteria->bobot,
                 'C4' => number_format($collect->relasis[0]->c4->nilai / $this->normalisasi($pendamping,'c4'),3) * $pendamping[0]->relasis[0]->c4->kriteria->bobot,
                 'C5' => number_format($collect->relasis[0]->c5->nilai / $this->normalisasi($pendamping,'c5'),3) * $pendamping[0]->relasis[0]->c5->kriteria->bobot,
            ];
        });

        // Perhitungan Yi
        self::$Yi = collect(self::$optimasi)->map(function($optimasi, $key){
            $collect = (object)$optimasi;
            return [
                 'id' => $collect->id,
                 'foto' => $collect->foto,
                 'no_ktp' => $collect->no_ktp,
                 'no_hp' => $collect->no_hp,
                 'email' => $collect->email,
                 'alamat' => $collect->alamat,
                 'nama' => $collect->nama,
                 'validasi' => $collect->validasi,
                 'MAX' => $collect->C1 + $collect->C2 + $collect->C4 + $collect->C5,
                 'MIN' => $collect->C3,
                 'Yi'  => ($collect->C1 + $collect->C2 + $collect->C4 + $collect->C5) - $collect->C3,
            ];
        });

        self::$hasil = collect(self::$Yi)->sortBy('Yi')->reverse();
    }

    public function laporanRanking(){
		$pendampings = CalonPendamping::all();

        $path = 'images/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $this->perhitungan_moora();
        $kriterias   = self::$kriterias;
        $pendampings   = self::$pendampings;
        $normalisasi = self::$normalisasi;
        $optimasi    = self::$optimasi;
        $Yi          = self::$Yi;
        $pendampings       = self::$hasil;

        $pendampings = collect($pendampings)->all();

        // dd($pendampings);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('laporan.ranking',compact('pendampings','base64'))
        // ->setOptions(['isPhpEnabled' => true])
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
	}

    public function laporanPendamping($id,$rank)
	{
        $jum = CalonPendamping::all()->count();
		$pendamping = CalonPendamping::find($id);

        $this->perhitungan_moora();
        $kriterias    = self::$kriterias;
        $pendampings  = self::$pendampings;
        $normalisasi  = self::$normalisasi;
        $optimasi_l   = self::$optimasi_l;
        $optimasi     = self::$optimasi;
        $Yi           = self::$Yi;
        $pendampingss = self::$hasil;

        // dd($pendampings);

        $normalisasi = collect($normalisasi)->where('id',$pendamping->id);
        $pendampingss = collect($pendampingss)->where('id',$pendamping->id);
        $optimasi_l = collect($optimasi_l)->where('id',$pendamping->id);
        $optimasi = collect($optimasi)->where('id',$pendamping->id);
        $Yi = collect($Yi)->where('id',$pendamping->id);
        $pendampings = collect($pendampings)->where('id',$pendamping->id);


        $path = 'images/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('laporan.pendamping',compact('pendamping','base64','rank','normalisasi','pendampings','pendampingss','optimasi','optimasi_l','jum','Yi'))
        // ->setOptions(['isPhpEnabled' => true])
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
	}
}
