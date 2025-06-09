<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/mysql', function () {
    try {
        DB::connection()->getPdo();
        echo "Conexão com a base de dados: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die("Não foi possível conectar com a base de dados . Erro: " . $e->getMessage());
    }
});

Route::get('/sqlite', function () {
    try {
        DB::connection()->getPdo();
        echo "Conexão com a base de dados: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die("Não foi possível conectar com a base de dados . Erro: " . $e->getMessage());
    }
});
