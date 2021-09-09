<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\LoginController as SiteLoginController;
use App\Http\Controllers\Site\RegisterController as SiteRegisterController;
use App\Http\Controllers\Panel\Dashboard\IndexController as PanelDashboardIndexController;
use App\Http\Controllers\Panel\LogoutController as PanelLogoutController;
use App\Http\Controllers\Panel\Profile\IndexController as PanelProfileIndexController;
use App\Http\Controllers\Panel\Profile\EditController as PanelProfileEditController;
use App\Http\Controllers\Panel\DeleteMyAccountController as PanelDeleteMyAccountController;
use App\Http\Controllers\Panel\ContactFormController as PanelContactFormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::name('site.')->group(function () {
    Route::get('/login', [SiteLoginController::class, 'index'])->name('login');
    Route::post('/login/store', [SiteLoginController::class, 'store'])->name('login.store');
    Route::get('/register', [SiteRegisterController::class, 'index'])->name('register');
    Route::post('/register/store', [SiteRegisterController::class, 'store'])->name('register.store');
});

Route::middleware(['auth'])->group(function () {
    Route::name('panel.')->group(function () {
        $urlPrefix = 'panel';
        Route::name('dashboard.')->group(function () use ($urlPrefix) {
            $prefix = 'dashboard';
            Route::get($urlPrefix."/".$prefix.'/', [PanelDashboardIndexController::class, 'index'])->name('index');
        });

        Route::get($urlPrefix."/logout", [PanelLogoutController::class, 'index'])->name('logout');
        Route::get($urlPrefix."/delete-my-account", [PanelDeleteMyAccountController::class, 'index'])->name('delete-my-account');

        Route::get($urlPrefix."/profile", [PanelProfileIndexController::class, 'index'])->name('profile');
        Route::get($urlPrefix."/profile/edit", [PanelProfileEditController::class, 'index'])->name('profile.edit');
        Route::post($urlPrefix."/profile/edit/store", [PanelProfileEditController::class, 'store'])->name('profile.edit.store');

        Route::get($urlPrefix."/contact-form", [PanelContactFormController::class, 'index'])->name('contact-form');
        Route::post($urlPrefix."/contact-form/store", [PanelContactFormController::class, 'store'])->name('contact-form.store');
    });
});


Route::fallback(function () {
    return redirect()->route('site.login');
});