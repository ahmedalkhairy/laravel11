<?php

use App\Events\ChatMessage;
use Illuminate\Support\Facades\Route;


Auth::routes();


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs.index');

//    Route::get('dashboard/main_stats', [DashboardController::class, 'index'])->name('dashboard.main_stats');

    // Prompts Routes
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/prompts', [App\Http\Controllers\PromptsController::class, 'index'])->name('prompts');
    Route::post('/prompts/generate', [App\Http\Controllers\PromptsController::class, 'generate'])->name('prompts.generate');

    Route::get('/prompts/create', [App\Http\Controllers\PromptsController::class, 'create'])->name('prompts.create');
    Route::get('/prompts/{id}/edit', [App\Http\Controllers\PromptsController::class, 'edit'])->name('prompts.edit');
    Route::put('/prompts/{id}/update', [App\Http\Controllers\PromptsController::class, 'update'])->name('prompts.update');
    Route::post('/prompts/store', [App\Http\Controllers\PromptsController::class, 'store'])->name('prompts.store');
    Route::get('/prompts/delete_all', [App\Http\Controllers\PromptsController::class, 'delete_all'])->name('prompts.delete_all');

    Route::delete('/prompts/{id}', [App\Http\Controllers\PromptsController::class, 'delete_prompt'])->name('prompts.delete');



    // Server Routes
    Route::get('/servers', [App\Http\Controllers\ServerController::class, 'index'])->name('servers.index');
    Route::get('/servers/{id}/status', [App\Http\Controllers\ServerController::class, 'server_status'])->name('servers.status');
    Route::get('/servers/create', [App\Http\Controllers\ServerController::class, 'create'])->name('servers.create');
    Route::post('/servers/store', [App\Http\Controllers\ServerController::class, 'store'])->name('servers.store');
    Route::delete('/servers/{id}', [App\Http\Controllers\ServerController::class, 'delete_instance'])->name('servers.delete');
    Route::get('/servers/{id}', [App\Http\Controllers\ServerController::class, 'show'])->name('servers.show');
    Route::get('/servers/{id}/sync', [App\Http\Controllers\ServerController::class, 'sync'])->name('servers.sync');
    Route::get('/servers/{id}/run_model', [App\Http\Controllers\ServerController::class, 'run_model'])->name('servers.run_model');
    Route::get('/servers/{id}/stop_server', [App\Http\Controllers\ServerController::class, 'stop_server'])->name('servers.stop_server');
    Route::get('/servers/{id}/start_server', [App\Http\Controllers\ServerController::class, 'start_server'])->name('servers.start_server');

    // Requests Routes
    Route::get('/requests', [App\Http\Controllers\RequestsController::class, 'index'])->name('requests.index');
    Route::get('/requests/{id}', [App\Http\Controllers\RequestsController::class, 'show'])->name('requests.show');
    Route::delete('/requests/{id}', [App\Http\Controllers\RequestsController::class, 'destroy'])->name('requests.delete');
    Route::get('/requests/{id}/retry', [App\Http\Controllers\RequestsController::class, 'retry'])->name('requests.retry');

    // categories Routes
    Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [App\Http\Controllers\CategoriesController::class, 'create'])->name('categories.create');

    Route::get('/categories/{id}', [App\Http\Controllers\CategoriesController::class, 'show'])->name('categories.show');
    Route::get('/categories/{id}/add_prompt', [App\Http\Controllers\CategoriesController::class, 'add_prompt'])->name('categories.add_prompt');
    Route::delete('/categories/{id}', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('categories.delete');
    Route::post('/categories/store', [App\Http\Controllers\CategoriesController::class, 'store'])->name('categories.store');
    Route::post('/categories/update-attributes/{id}', [App\Http\Controllers\CategoriesController::class, 'updateAttributes'])->name('categories.update_attributes');


    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

});
