<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function create(){
        $data = ['title' => 'Profile'];

        return view('admin.profile.create', $data);
    }
}
