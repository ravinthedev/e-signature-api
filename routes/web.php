<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-env', function () {
    return env('DB_HOST');
});

Route::get('/check-db', function () {
    try {
        DB::connection()->getPdo();
        return response()->json(['message' => 'Database connection is working!'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Could not connect to the database. Please check your configuration.', 'error' => $e->getMessage()], 500);
    }
});