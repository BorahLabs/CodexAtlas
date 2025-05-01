<?php

use App\Http\Controllers\RedirectToBuyout;
use App\Http\Middleware\ForceNoIndex;
use Illuminate\Support\Facades\Route;

require __DIR__.'/automaticdocs.php';

require __DIR__.'/codex.php';

Route::view('/buyout', 'buyout')->name('buyout')->middleware(ForceNoIndex::class);
Route::post('/redirect-to-buyout', RedirectToBuyout::class)->name('redirect-to-buyout')->middleware(ForceNoIndex::class);
Route::view('/buyout-success', 'buyout-success')->name('buyout-success')->middleware(ForceNoIndex::class);
