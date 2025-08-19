<?php
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/staff.php';

Route::get('/', function(){
    return redirect('/login');
});
