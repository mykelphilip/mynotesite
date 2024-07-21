<?php
use App\Http\Controllers\noteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/name')->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function(){
        // Route::get('/note',[noteController::class, 'index'])->name('note.index');
                // Route::get('/note/create',[noteController::class, 'create'])->name('note.create');
                // Route::post('/note',[noteController::class, 'store'])->name('note.store');
                // Route::get('/note{id}',[noteController::class, 'show'])->name('note.show');
                // Route::get('/note{id}/edit',[noteController::class, 'edit'])->name('note.edit');
                // Route::put('/note/{id}',[noteController::class, 'update'])->name('note.update');
                // Route::delete('/note/{id}',[noteController::class, 'destory'])->name('note.destory');
    
    
    Route::resource('/note', noteController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
