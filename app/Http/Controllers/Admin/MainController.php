<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// MODELS
use App\Models\User;

class MainController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user();
        return view('admin.dashboard', compact('user'));
    }

}
