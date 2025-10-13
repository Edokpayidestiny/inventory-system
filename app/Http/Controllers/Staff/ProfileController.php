<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Profile',
            'user' => Auth::user(),
        ];
        return view('staff.profile.index', $data);
    }
}
