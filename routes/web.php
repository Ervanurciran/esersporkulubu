<?php

use Illuminate\Support\Facades\Route;

// ─── FRONTEND CONTROLLERS ────────────────────────────────────
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CorporateController;
use App\Http\Controllers\Frontend\BranchController;
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\Frontend\AnnouncementsController as FrontendAnnouncement;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\ContactController;

// ─── ADMIN CONTROLLERS ───────────────────────────────────────
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\CorporateController as AdminCorporateController;
use App\Http\Controllers\Admin\BranchController as AdminBranchController;
use App\Http\Controllers\Admin\CoachController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\FixtureController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\StandingController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\AnnouncementsController as AdminAnnouncement;
use App\Http\Controllers\Admin\GalleryAlbumController;
use App\Http\Controllers\Admin\GalleryMediaController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('hakkimizda')->name('about.')->group(function () {
    Route::get('/',              [AboutController::class, 'history']) ->name('index');
    Route::get('/tarihce',       [AboutController::class, 'history']) ->name('history');
    Route::get('/misyon-vizyon', [AboutController::class, 'mission']) ->name('mission');
});

Route::prefix('kurumsal')->name('corporate.')->group(function () {
    Route::get('/',               [CorporateController::class, 'index'])    ->name('index');
    Route::get('/baskan',         [CorporateController::class, 'president'])->name('president');
    Route::get('/yonetim-kurulu', [CorporateController::class, 'board'])    ->name('board');
    Route::get('/denetim-kurulu', [CorporateController::class, 'audit'])    ->name('audit');
    Route::get('/tuzuk',          [CorporateController::class, 'statute'])  ->name('statute');
});

Route::prefix('branslar')->name('branch.')->group(function () {
    Route::get('/', [BranchController::class, 'index'])->name('index');
    Route::prefix('{slug}')->group(function () {
        Route::get('/',            [BranchController::class, 'show'])      ->name('show');
        Route::get('/fikstur',     [BranchController::class, 'fixture'])   ->name('fixture');
        Route::get('/sonuclar',    [BranchController::class, 'results'])   ->name('results');
        Route::get('/puan-durumu', [BranchController::class, 'standings']) ->name('standings');
        Route::get('/antrenorler', [BranchController::class, 'coaches'])   ->name('coaches');
    });
});

Route::prefix('haberler')->name('news.')->group(function () {
    Route::get('/',            [FrontendNewsController::class, 'index'])  ->name('index');
    Route::get('/haberler',    [FrontendNewsController::class, 'news'])   ->name('news');
    Route::get('/etkinlikler', [FrontendNewsController::class, 'events']) ->name('events');
    Route::get('/{slug}',      [FrontendNewsController::class, 'show'])   ->name('show');
});

Route::prefix('duyurular')->name('announcement.')->group(function () {
    Route::get('/',       [FrontendAnnouncement::class, 'index'])->name('index');
    Route::get('/{slug}', [FrontendAnnouncement::class, 'show']) ->name('show');
});

Route::prefix('galeri')->name('gallery.')->group(function () {
    Route::get('/',       [GalleryController::class, 'index'])->name('index');
    Route::get('/{slug}', [GalleryController::class, 'show']) ->name('show');
});

Route::prefix('iletisim')->name('contact.')->group(function () {
    Route::get('/form',  [ContactController::class, 'form'])    ->name('form');
    Route::post('/form', [ContactController::class, 'send'])    ->name('send');
    Route::get('/konum', [ContactController::class, 'location'])->name('location');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/giris',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/giris', [AuthController::class, 'login'])    ->name('login.post');
    Route::post('/cikis', [AuthController::class, 'logout'])   ->name('logout');

    Route::middleware(['admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('slider', SliderController::class);

        Route::prefix('hakkimizda')->name('about.')->group(function () {
            Route::get('/',              [AdminAboutController::class, 'index'])         ->name('index');
            Route::get('/tarihce',       [AdminAboutController::class, 'editHistory'])   ->name('history.edit');
            Route::put('/tarihce',       [AdminAboutController::class, 'updateHistory']) ->name('history.update');
            Route::get('/misyon-vizyon', [AdminAboutController::class, 'editMission'])   ->name('mission.edit');
            Route::put('/misyon-vizyon', [AdminAboutController::class, 'updateMission']) ->name('mission.update');
        });

        Route::prefix('kurumsal')->name('corporate.')->group(function () {
            Route::get('/',              [AdminCorporateController::class, 'index'])          ->name('index');
            Route::get('/ekle',          [AdminCorporateController::class, 'create'])         ->name('create');
            Route::post('/ekle',         [AdminCorporateController::class, 'store'])          ->name('store');
            Route::get('/{uye}/duzenle', [AdminCorporateController::class, 'edit'])           ->name('edit');
            Route::put('/{uye}',         [AdminCorporateController::class, 'update'])         ->name('update');
            Route::delete('/{uye}',      [AdminCorporateController::class, 'destroy'])        ->name('destroy');
            Route::get('/tuzuk',         [AdminCorporateController::class, 'editStatute'])    ->name('statute.edit');
            Route::put('/tuzuk',         [AdminCorporateController::class, 'updateStatute'])  ->name('statute.update');
        });

        Route::resource('branslar', AdminBranchController::class);

        Route::get('branslar/{id}/cover/remove', function ($id) {
            $branch = \App\Models\Branch::findOrFail($id);
            if ($branch->cover_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($branch->cover_image);
                $branch->update(['cover_image' => null]);
            }
            return redirect()->route('admin.branslar.edit', $id)->with('success', 'Kapak görseli kaldırıldı.');
        })->name('branslar.cover.remove');

        Route::prefix('branslar/{branch}')->name('branch.')->group(function () {
            Route::resource('antrenorler', CoachController::class);
            Route::resource('oyuncular',   PlayerController::class);
            Route::resource('fikstur',     FixtureController::class);
            Route::resource('sonuclar',    ResultController::class);
            Route::resource('puan-durumu', StandingController::class);
        });

        // ─── HABERLER ────────────────────────────────────────────────
        Route::resource('haberler', AdminNewsController::class)->names('news');
        Route::get('haberler-listesi',    [AdminNewsController::class, 'haberler'])   ->name('news.haberler');
        Route::get('etkinlikler-listesi', [AdminNewsController::class, 'etkinlikler'])->name('news.etkinlikler');

        // ─── DUYURULAR ───────────────────────────────────────────────
        Route::resource('duyurular', AdminAnnouncement::class)->names('announcement');

        // ─── GALERİ ──────────────────────────────────────────────────
        Route::resource('galeri', GalleryAlbumController::class);

        Route::prefix('galeri/{album}')->name('galeri.')->group(function () {
            Route::resource('medya', GalleryMediaController::class);
            Route::post('medya/toplu-yukle', [GalleryMediaController::class, 'bulkUpload'])->name('medya.bulk');
        });

        // ─── İLETİŞİM ────────────────────────────────────────────────
        Route::prefix('iletisim')->name('contact.')->group(function () {
            Route::get('/',           [AdminContactController::class, 'index'])   ->name('index');
            Route::get('/{id}',       [AdminContactController::class, 'show'])    ->name('show');
            Route::delete('/{id}',    [AdminContactController::class, 'destroy']) ->name('destroy');
            Route::patch('/{id}/oku', [AdminContactController::class, 'markRead'])->name('read');
        });

        // ─── KULLANICILAR ─────────────────────────────────────────────
        Route::resource('kullanicilar', UserController::class);

    });
});