<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
   public function index()
   {
       $data = [
           'title' => 'Profile',
           'user' => Auth::user(),
       ];
       return view('admin.profile.index', $data);
   }
}
