<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KomenController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\TokenWebController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\JadwalController;
use GuzzleHttp\Psr7\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/materi-video-comment/{vids_id}',[KomenController::class,'display_komen_video']);
Route::post('/post-comment-video',[KomenController::class,'post_komen_video']);
Route::get('/display-komen/{vids_id}',[KomenController::class,'display_komen']);
Route::post('tokenweb',TokenWebController::class);
Route::get('/get-my-notif',[NotifController::class,'get_my_notif']);
Route::get('/update-notif-jadwal-admin',[JadwalController::class,'update_notif_jadwal_admin']);
Route::get('/test',[NotifController::class,'test']);
Route::get('/read-all-notif',[NotifController::class,'read_all_notif']);
Route::get('/dropdown-hari',[JadwalController::class,'dropdown_hari']);
Route::get('/admin-jadwal',[JadwalController::class,'admin_jadwal']);

Route::controller(UserController::class)->group(function(){
    Route::get('/admin-daftar-user','daftar_user');
    Route::post('/admin-ubah-password','ubah_password');
    Route::post('/admin-ubah-photo','ubah_photo');
    Route::post('/admin-user-baru','user_baru');
    
    Route::post('/update-user','update_user');
    Route::post('/hapus-user','hapus_user');
});

Route::controller(DashboardController::class)->group(function(){
    Route::get('/total-user-online','total_user_online');
    Route::get('/last-4-online-user','last_four_online');
    Route::get('/user-akses','akses_user');
    Route::get('/data-user-online','data_user_online');
    Route::get('/data-user-akses/{tanggal}','data_user_akses');
});
 
Route::group(['middleware' => ['auth', 'CheckRole:admin']], function () {

    Route::controller(ExamController::class)->group(function(){
        Route::get('/admin-manajemen-ujian','manajemen_ujian');
        Route::get('/admin-exam-kelas','exam_kelas');
        Route::post('/admin-remove-exam','exam_remove');
        Route::get('/admin-kelas-keseluruhan/{exam_id}','kelas_keseluruhan');
        Route::get('/admin-kelas-keseluruhan2/{exam_id}','kelas_keseluruhan2');
        Route::get('/admin-kelas-saatini/{exam_id}','kelas_saatini');
        Route::get('/admin-kelas-saatini2/{exam_id}','kelas_saatini2');
        Route::post('/admin-add-exam-kelas','tambah_kelas_ke_exam');
        Route::post('/admin-add-exam-kelas2','tambah_kelas_ke_exam2');
        Route::post('/admin-remove-exam-kelas','remove_kelas_di_exam');
        Route::post('/admin-remove-exam-kelas2','remove_kelas_di_exam2');
        Route::get('/admin-total-exam','total_exam');

        Route::get('/admin-manajemen-ujian-urai','manajemen_ujian_urai');
        Route::get('/admin-total-exam-urai','total_exam_urai');
        Route::post('/admin-remove-exam-urai','examurai_remove');

        Route::get('/halaman-unduh-hasil-uraian','halaman_unduh_hasil_uraian');
        Route::get('/proses-data-ujian-uraian/{kelas_id}/{tgl_awal}/{tgl_akhir}','proses_data_ujian_uraian');
        Route::post('/unduh-hasil-ujian-uraian','unduh_hasil_ujian_uraian');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('admin-daftar-user', 'daftar_user');
    });

    Route::controller(DashboardController::class)->group(function () {
        route::get('/admin-dashboard', 'admin_dashboard_page');
    });

    Route::controller(JurusanController::class)->group(function () {
        Route::get('/admin-jurusan', 'admin_jurusan');
        Route::post('/admin-post-jurusan', 'post_jurusan');

        Route::get('/admin-jurusan-&-kelas', 'admin_jurusan_kelas_page');
        Route::get('/admin-total-jurusan-&-kelas', 'total_jurusan_kelas');
        Route::post('/admin-post-jurusan-&-kelas', 'post_jurusan_kelas');
        Route::get('/admin-tingkat-dropdown', 'tingkat_dropdown');
        Route::get('/admin-jurusan-dropdown', 'jurusan_dropdown');
        Route::get('/admin-angkatan-dropdown', 'angkatan_dropdown');
        Route::get('/admin-dropdown-mapel-kelas/{kelas_id}', 'mapelkelas_dropdown');
        Route::get('/admin-chagne-dropdown-jurusan/{jurusan_id}', 'change_dropdown_jurusan');
        Route::get('/admin-chagne-dropdown-angkatan/{angkatan_id}', 'change_dropdown_angkatan');
        Route::post('/admin-remove-kelas', 'remove_kelas');
        Route::get('/admin-daftar-jurusan', 'daftar_jurusan');
        Route::post('/admin-remove-jurusan', 'remove_jurusan');
        Route::post('/admin-update-kelas', 'update_kelas');
        Route::post('/admin-update-jurusan', 'update_jurusan');

        Route::get('/admin-data-siswa-belum-masuk-kelas','siswa_belum_masuk_kelas');
        Route::post('/admin-tambah-siswa-baru','tambah_siswa_baru');

        Route::get('/daftar-mapel-kelas/{kelas_id}','daftar_mapel_kelas');
        Route::post('/remove-mapel-kelas','remove_mapel_kelas');
        Route::get('/daftar-kelas-yang-akan-dicopas','daftar_copas');
        Route::post('/copas-mapel-kelas','copas_mapel_kelas');

        Route::get('/daftar-guru-kelas/{kelas_id}','daftar_guru_kelas');
        Route::post('/hapus-mapel-master','hapus_mapel_master');
    });

    Route::controller(AngkatanController::class)->group(function () {
        Route::get('/admin-angkatan', 'admin_angkatan');
        Route::get('/admin-total-angkatan', 'total_angkatan');
        Route::post('/admin-post-angkatan', 'post_angkatan');
        Route::post('/admin-remove-angkatan', 'remove_angkatan');
    });

    Route::controller(MapelController::class)->group(function () {
        Route::get('/admin-mapel', 'admin_mapel');
        Route::get('/admin-total-mapel', 'total_mapel');
        Route::get('/admin-get-mapel', 'get_mapel');
        Route::post('/admin-remove-mapel', 'remove_mapel');
        Route::post('/admin-post-mapel', 'post_mapel');
        Route::post('/admin-update-mapel', 'update_mapel');

        Route::post('/admin-post-kelas-mapel', 'post_kelas_mapel');
    });

    Route::controller(SiswaController::class)->group(function () {
        Route::get('/admin-siswa', 'admin_siswa');
        Route::get('/admin-siswa-kelas/{kelas_id}', 'siswa_kelas');
        Route::post('/admin-ubah-status-siswa', 'status_siswa');
    });

    Route::controller(ExportController::class)->group(function () {
        Route::get('/admin-download-template-siswa/{kelas_id}', 'download_template_siswa');
        Route::get('/admin-download-template-guru', 'download_template_guru');
        Route::get('/admin-download-template-mapel', 'download_template_mapel');
        Route::get('/admin-download-template-quiz', 'download_template_quiz');
        Route::get('/admin-download-template-examurai','download_template_examurai');

        Route::post('/admin-download-user-kelas','download_user_kelas');
    });

    Route::controller(ImportController::class)->group(function () {
        Route::post('/admin-import-data-siswa', 'import_data_siswa');
        Route::post('/admin-import-data-guru', 'import_data_guru');
        Route::post('/admin-import-data-mapel', 'import_data_mapel');
        Route::post('/admin-import-data-quiz', 'import_data_quiz');
        Route::post('/admin-import-data-examurai','import_data_examurai');
    });

    Route::controller(GuruController::class)->group(function () {
        Route::get('/admin-guru', 'admin_guru');
        Route::get('/admin-total-guru', 'total_guru');
        Route::post('/admin-post-guru', 'post_guru');

        Route::post('/admin-post-mapel-master', 'post_mapel_master');
        Route::post('/admin-post-mapel-master2', 'post_mapel_master2');
    });
});

Route::group(['middleware' => ['auth', 'CheckRole:siswa']], function () {
    Route::controller(LandingController::class)->group(function () {
        Route::get('/home-lms', 'home_lms');
        Route::post('/submit-missing-data-siswa','submit_missing_data')->name('submit.missing_data_siswa');
    });
});

Route::group(['middleware' => ['auth', 'CheckRole:guru,admin']], function () {
    Route::controller(LandingController::class)->group(function () {
        Route::get('/home-lms-guru', 'home_lms_guru');
        Route::get('/home-lms-guru', 'home_lms_guru');
        Route::get('/guru-download-template-ujian/{number_soal}', 'download_template_ujian');
    });
    Route::controller(ImportController::class)->group(function () {
        Route::post('/admin-import-data-quiz', 'import_data_quiz');
        Route::post('/admin-import-data-exam', 'import_data_exam');
    });
    Route::controller(GuruController::class)->group(function() {
        Route::post('/update-photo-guru','update_photo');
        Route::post('/update-photo-guru2','update_photo2');
        Route::post('/update-bio','update_bio');
    });
});

Route::group(['middleware' => ['auth', 'CheckRole:guru,siswa']], function () {
    Route::controller(TugasController::class)->group(function(){
        Route::post('/post-tugas-siswa', 'post_tugas');
        Route::post('/post-dokumen-tugas-siswa','post_docstugas');
        Route::get('/download-docstugas/{docstugas_id}','download_docstugas');
        Route::post('/remove-docs-tugas','remove_docstugas');
        Route::get('/cek-tugas-siswa/{mapelmaster_id}/{tugas_id}','cek_tugas_siswa');

        Route::post('/post-jawaban-tugas-siswa','post_jawab_tugas');
        Route::post('/post-jawaban-tugas-siswa2','post_jawab_tugas2');
        Route::get('/download-jawaban-tugas-siswa/{jawabtugas_id}','download_tugasku');
    });
 
    Route::controller(PelajaranController::class)->group(function () {
        Route::get('/mapel/{mapelmaster_id}', 'mapel_mapelmaster');
        Route::get('/mapel-siswa/{mapelmaster_id}', 'mapel_mapelmaster_siswa');
        Route::get('/cek-nilai-siswa/{kelas_id}/{mapelmaster_id}/{ujian_id}','cek_nilai_siswa');
    });
    Route::controller(MateriController::class)->group(function () {
        Route::post('/post-materi', 'post_materi');
        Route::post('/post-vids', 'post_vids');
        Route::post('/remove-vids','remove_vids');
        Route::post('/remove-docs','remove_docs');
        Route::post('/post-docs', 'post_docs');
        Route::get('/download-docs/{docs_id}', 'download_docs');

        Route::post('/hapus-materi','hapus_materi');
        Route::post('/update-materi','update_materi');
    });
    Route::controller(SiswaController::class)->group(function() {
        Route::post('/update-photo-siswa','update_photo');
    });
});
Route::get('/cek-siswa/{kelas_id}',[PelajaranController::class,'cek_siswa']);
// Route::get('/do-quiz',function(){
//     return view('fe_page.do_quiz');
// });

Route::get('/do-quiz/{mapelmaster_id}/{materi_id}/{ujian_id}', [QuizController::class, 'doQuiz'])->name('doQuiz');
Route::post('/post-quiz', [QuizController::class, 'postQuiz'])->name('postQuiz');
Route::get('/prev-quiz/{mapelmaster_id}/{materi_id}/{ujian_id}', [QuizController::class, 'prevQuiz'])->name('prevQuiz');
Route::get('/prev-exam/{exam_id}', [ExamController::class, 'prev_exam'])->name('doExamPrev');
Route::post('/ujianStore', [QuizController::class, 'ujianStore'])->name('ujianStore');
Route::post('/remove-quiz',[QuizController::class,'remove_quiz']);
// Route::post('/post-quiz', [QuizController::class, 'postQuiz'])->name('postQuiz');

Route::get('/daftar-ujian/{kelas_id}',[ExamController::class,'daftar_pilihan_ganda']);
Route::get('/daftar-ujian-uraian/{kelas_id}',[ExamController::class,'daftar_uraian']);
Route::get('/do-exam/{exam_id}/{mapel_id}/{kelas_id}',[ExamController::class,'doExam'])->name('doExam');
Route::post('/post-exam',[ExamController::class,'postExam'])->name('postExam');

Route::get('/do-exam-uraian/{examurai_id}/{mapel_id}/{kelas_id}',[ExamController::class,'do_exam_urai']);
Route::get('/do-exam-uraian-next/{examurai_id}/{mapel_id}/{kelas_id}/{next}/{nomorurut}',[ExamController::class,'do_exam_urai_next']);
Route::post('/menjawab-uraian',[ExamController::class,'menjawab_uraian']); 

Route::get('/rekap-nilai',[ExamController::class,'rekapNilai'])->name('rekapNilai');
Route::get('/daftar-peringkat',[ExamController::class,'daftarPeringkat'])->name('daftarPeringkat');
Route::get('/daftar-ranking-kelas',[ExamController::class,'data_ranking_kelas'])->name('data_ranking_kelas');
Route::post('/update-ranking-kelas',[ExamController::class,'update_rank']);

Route::get('/periksa-jawaban-uraian/{mapelmaster_id}',[ExamController::class,'periksa_jawaban_uraian']);
Route::get('/daftar-uraian-siswa/{examurai_id}/{kelas_id}/{guru_id}',[ExamController::class,'daftar_uraian_siswa']);
Route::get('/periksa-jawaban-uraian-siswa/{siswa_id}/{kelas_id}/{guru_id}/{examurai_id}',[ExamController::class,'periksa_jawaban_uraian_siswa']);
Route::get('/periksa-jawaban-uraian-siswa-next/{siswa_id}/{kelas_id}/{guru_id}/{examurai_id}/{id}/{nomorurut}',[ExamController::class,'periksa_jawaban_uraian_siswa_next']);
Route::post('/submit-periksa-uraian',[ExamController::class,'sumbit_periksa_uraian']);






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

