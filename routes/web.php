<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/guru', function () {
    return view('guru.index');
});

Route::get('/ekstra', function () {
    return view('ekstra.index');
});

Route::get('/spmb', function () {
    return view('spmb.index');
});

Route::get('/kritik-saran', function () {
    return view('kritik saran.index');
});

Route::get('/prestasi', function () {
    return view('prestasi.index');
});

Route::get('/kontak', function () {
    return view('kontak.index');
});
