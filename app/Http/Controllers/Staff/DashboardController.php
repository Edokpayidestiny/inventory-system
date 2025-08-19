<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index() {
        $data = ['title' => 'Staff'];

        return view('staff.index', $data);
    }
}
