<?php

namespace App\Http\Controllers;

use App\Models\Jawabanmulti;
use App\Models\Siswa;
use App\Models\Soalmulti;
use App\Models\Ujian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuizController extends Controller
{

    public function addUjian()
    {
    }

    public function doQuiz($mapelmaster_id,$materi_id,$id, Request $request)
    {
        
        $request->siswaId =  Siswa::where('user_id', Auth::id())->first()->id;
        $request->ujian_id = $id;
        if ($request->jawabanId) {
            $data = Jawabanmulti::where('siswa_id', $request->siswaId)
                ->where('ujian_id', $request->ujian_id)
                ->where('soalmulti_id', $request->soalId)->first();
            $data->optionmulti_id = $request->jawabanId;
            $data->jawabanku = $request->jawabanId;
            $data->save();
        }
        $quiz = Soalmulti::where('ujian_id', $id)->inRandomOrder()->get();
        $cond = Jawabanmulti::where('siswa_id', $request->siswaId)
            ->where('ujian_id', $request->ujian_id);
        if ($cond->count() <= 0) {
            foreach ($quiz as $key => $value) {
                Jawabanmulti::firstOrCreate([
                    'siswa_id' => $request->siswaId,
                    'mapelmaster_id' => $request->mapelmaster_id,
                    'materi_id' => $request->materi_id,
                    'ujian_id' => $request->ujian_id,
                    'soalmulti_id' => $value->id,
                    'optionmulti_id' => null,
                    'jawabanku' => null,
                ]);
            }
        }
        $ujian = Ujian::find($request->ujian_id);
        $now = Carbon::parse(Carbon::now());
        if ($now < $ujian->ujian_datetimestart) {
            #abaikan
            // return 'belum dibuka pages here'; //bisa redirect pages
            // $status = 0;
            // return redirect()->route('home')->with('warning', 'ujian belum dibuka');
        }
        if ($now > $ujian->ujian_datetimeend) {
            // return 'expired'; //bisa redirect pages
            // $status = 2;
            return redirect()->route('home')->with('success', 'ujian telah berakhir');
        }
        // 
        $quizCount = Soalmulti::where('ujian_id', $ujian->id)->count();
        $jawabanCount = Jawabanmulti::where('siswa_id', $request->siswaId)
            ->where('ujian_id', $id)
            // ->where('optionmulti_id', '!=', 0)
            ->count();
        $nextQuiz = Jawabanmulti::where('siswa_id', $request->siswaId)
            ->where('ujian_id', $request->ujian_id)
            // ->where('optionmulti_id', '!=', 0)
            ->first();
        $quizPanel = Jawabanmulti::where('siswa_id', $request->siswaId)
            ->where('ujian_id', $id)
            // ->where('optionmulti_id', '!=', 0)
            ->orderBy('id', 'asc')
            ->get();

        $soal = Soalmulti::where('ujian_id', $request->ujian_id)->with(['OptionMulti'])->orderBy('id', 'desc')->first();
        // $quiz = Soalmulti::inRandomOrder()->Get();
        // $arx = Jawabanmulti::where('siswa_id', $request->siswaId)
        //     ->where('ujian_id', $request->ujian_id)->orderBy('id', 'asc')->orderBy('id', 'asc')->pluck('id')->toArray();
        if ($jawabanCount >= $quizCount) {
            // return 'all soal done pages';
        } else {
            $soal = Soalmulti::where('id', $nextQuiz->soalmulti_id)->orderBy('id', 'desc')->with(['OptionMulti'])->first();
        };
        
        if ($request->byPanel) {
            $jawaban = Jawabanmulti::where('siswa_id', $request->siswaId)
                ->where('ujian_id', $request->ujian_id)
                ->where('soalmulti_id', $request->byPanel)->first();
            $soal = Soalmulti::where('id', $request->byPanel)->with(['OptionMulti'])->first();
            $soal->jawabanSiswa = $jawaban->optionmulti_id;
            // foreach ($arx as $key => $value) {
            //     if ($value == $soal->id) $indx = $key + 1;
            // }
        }
        $indx = 1;
        $arr = Jawabanmulti::where('siswa_id', $request->siswaId)
            ->where('ujian_id', $request->ujian_id)->orderBy('id', 'asc')->pluck('soalmulti_id')->toArray();
        foreach ($arr as $key => $value) {
            # code...
            // return $value;
            if ($value == $soal->id) {
                // return $value . ';'.$soal->id;
                $indx = $key ;
                // return $key;
            }
        }
        // $indx = array_search($soal->id, $arr);
        // return $indx;
        $indx++;
        $opts = ['A', 'B', 'C', 'D', 'E'];
        return view('fe_page.do_quiz')->with([
            'quizCount' => $quizCount,
            'quiz' => $ujian,
            'indx' => $indx,
            'q' => $soal,
            'index' => $indx, //$count,
            'opts' => $opts,
            'quizPanel' => $quizPanel,
            'mapelmaster_id'=> $mapelmaster_id,
            'materi_id'=> $materi_id
        ]);
    }

    public function prevQuiz($mapelmaster_id,$materi_id,$id, Request $request)
    {
        // $request->siswaId =  Siswa::where('user_id', Auth::id())->first()->id;
        $request->siswaId = auth()->user()->id;
        $request->ujian_id = $id;
       
        $quiz = Soalmulti::where('ujian_id', $id)->inRandomOrder()->get();
        $ujian = Ujian::find($request->ujian_id);
        $now = Carbon::parse(Carbon::now());
        $quizCount = Soalmulti::where('ujian_id', $ujian->id)->count();
        $jawabanCount = Jawabanmulti::where('siswa_id', $request->siswaId)
            ->where('ujian_id', $id)
            ->where('optionmulti_id', '!=', null)
            ->count();
        // $quizPanel = Jawabanmulti::where('siswa_id', $request->siswaId)
        //     ->where('ujian_id', $id)->orderBy('id', 'asc')->get();
        $quizPanel = Soalmulti::where('ujian_id', $id)->get();
        $soal = [];
        if ($jawabanCount >= $quizCount) {
            // return 'all soal done pages';
        } else {
            
            $soal = Soalmulti::where('ujian_id', $id)->with(['OptionMulti'])->first();
        }
        if ($request->byPanel) {
            // $jawaban = Soalmulti::where('ujian_id', $request->ujian_id)
            //     ->where('soalmulti_id', $request->byPanel)->first();
            $soal = Soalmulti::where('id', $request->byPanel)->with(['OptionMulti'])->first();
            // $soal = $jawaban->id;
            $ke = $request->ke;
        }else {
            # code...
            $ke = 1;
        }

        $opts = ['A', 'B', 'C', 'D', 'E'];
        return view('fe_page.do_quiz_preview')->with([
            'quizCount' => $quizCount,
            'quiz' => $ujian,
            'q' => $soal,
            'index' => 0, //$count,
            'opts' => $opts,
            'quizPanel' => $quizPanel,
            'mapelmaster_id' => $mapelmaster_id,
            'materi_id'=> $materi_id,
            'ke' => $ke,
        ]);
    }

    public function postQuiz(Request $request)
    {
        try {
            $request->siswaId =  Siswa::where('user_id', Auth::id())->first()->id;
            $data = Jawabanmulti::where('siswa_id', $request->siswaId)
                ->where('mapelmaster_id', $request->mapelmaster_id)
                ->where('materi_id', $request->materi_id)
                ->where('ujian_id', $request->ujianId)
                ->where('soalmulti_id', $request->soalId)->first();
            $data->optionmulti_id = $request->jawabanId;
            $data->jawabanku = $request->option_true;
            $data->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function finishQuiz(Request $request)
    {
        return redirect('/');
        // return 'finish here';
        // return $request->all();
    }

    public function ujianStore(Request $request)
    {
        try {
            $data = $request->all();
            $data['ujian_jenis'] = 1;
            $data['ujian_slug'] = Str::slug($request['ujian_name']) . '-' . Str::random(5);
            $data['ujian_datetimestart'] = (string) Carbon::parse($request['ujian_datetimestart'])->Format('Y-m-d h:i') . ":00";
            $data['ujian_datetimeend'] = (string) Carbon::parse($request['ujian_datetimeend'])->Format('Y-m-d h:i') . ":00";
            // return $data;
            Ujian::create($data);
            return response()->json([
                'status' => 200,
                'message' => 'Ujian baru ditambahkan'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function remove_quiz(Request $request)
    {
        $ujian = Ujian::where('id',$request->id)->withcount(['soal','jawabanmulti'])->first();
        if ($ujian) {
            # code...
            if ($ujian->soal_count > 0) {
                # code...
                Soalmulti::where('ujian_id',$request->id)->delete();
            }

            if ($ujian->jawabanmulti_count > 0) {
                # code...
                Jawabanmulti::where('ujian_id',$request->id)->delete();
            }

            $ujian->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Quiz berhasil dihapus'
            ]);
        }else {
            # code...
            return response()->json([
                'status'=>400,
                'message'=>'Data tidak ditemukan'
            ]);
        }
    }
}
