<?php

use App\Http\Controllers\MembershipCardController;
use Illuminate\Support\Facades\Route;

Route::resource('membership_cards', MembershipCardController::class);

// Atau jika menggunakan route manual:
Route::get('/membership_cards', [MembershipCardController::class, 'index'])->name('membership_cards.index');
Route::get('/membership_cards/create', [MembershipCardController::class, 'create'])->name('membership_cards.create');
Route::post('/membership_cards', [MembershipCardController::class, 'store'])->name('membership_cards.store');
Route::get('/membership_cards/{membership_card}', [MembershipCardController::class, 'show'])->name('membership_cards.show');
Route::get('/membership_cards/{membership_card}/edit', [MembershipCardController::class, 'edit'])->name('membership_cards.edit');
Route::put('/membership_cards/{membership_card}', [MembershipCardController::class, 'update'])->name('membership_cards.update');
Route::delete('/membership_cards/{membership_card}', [MembershipCardController::class, 'destroy'])->name('membership_cards.destroy');

// Atau jika ingin menambahkan route khusus untuk dashboard atau lainnya
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/', function () {
    return redirect()->route('membership_cards.index');
});
