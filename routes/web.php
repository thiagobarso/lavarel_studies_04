<?php

use Illuminate\Support\Facades\Config;
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

Route::get('/myconnection', function () {
    try {
        DB::connection('myconnection')->getPdo();
        echo "Conexão com a base de dados: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die("Não foi possível conectar com a base de dados . Erro: " . $e->getMessage());
    }
});

Route::get('/mysql_test_two_databases', function () {
    try {
        // primeira base de dados
        DB::connection('mysql_users')->getPdo();
        echo "Sucesso: " . DB::connection('mysql_users')->getDatabaseName();
        echo "<br>";

        // segunda base de dados
        DB::connection('mysql_app')->getPdo();
        echo "Sucesso: " . DB::connection('mysql_app')->getDatabaseName();
        echo "<br>";
    } catch (\Exception $e) {
        die("Erro: " . $e->getMessage());
    }
});

Route::get('/mysql_test_dynamic_connection', function () {
    try {
        Config::set('database.connections.mysql', [
            'driver' => 'mysql',
            'url' => '',
            'host' => 'localhost',
            'port' => '3306',
            'database' => 'laravel_mysql_auth',
            'username' => 'user_laravel_mysql_database',
            'password' => 'q2WO6aBI637EyoMiLeBi4AqOB2f8yi',
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ]);

        DB::connection('mysql')->getPdo();
        echo 'Ligação OK!';
    } catch (\Exception $e) {
        echo 'Deu erro!';
    }
});
