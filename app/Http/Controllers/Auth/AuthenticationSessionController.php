<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLoginRequest;
use Illuminate\Contracts\Cache\Store;

class AuthenticationSessionController extends Controller
{
    public function create(){
        return view('auth.login', ['title' => 'Login Account']);
    }

    public function store(StoreLoginRequest $request) {
        $attributes = $request->validated();
        if(Auth::attempt($attributes)) {
           request()->session()->regenerate();
            $user = Auth::user();

            if($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin');
            } elseif($user->role == 'staff') {
                return redirect()->route('staff.dashboard')->with('success', 'Welcome Staff');
            }
        } else {
            throw ValidationException::withMessages([
                'error' => 'Invalid credentials'
            ])->redirectTo(route('login'));
        }
    }

    public function destroy(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

}
