<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// MODELS
use App\Models\User;
use App\Models\Apartment;

class MainController extends Controller
{

    // public function dashboard()
    // {
    //     $user = auth()->user();
    //     return view('admin.dashboard', compact('user'));
    // }

    public function showDashboard()
    {
        $user = auth()->user();

        $apartments = Apartment::where('user_id', $user->id)->get();

        // Ensure the user is authenticated
        if (!$user) {
            return redirect()->route('login');
        }

        // Query to fetch message counts for only the authenticated user's apartments
        $messageCounts = DB::table('messages')
            ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
            ->join('users', 'apartments.user_id', '=', 'users.id')
            ->select(
                'apartments.title as apartment_name',
                DB::raw('CONCAT(users.name, " ", users.surname) as owner_name'),
                DB::raw('COUNT(messages.id) as message_count')
            )
            ->where('apartments.user_id', $user->id)  // Ensure filtering by authenticated user's apartments
            ->groupBy('messages.apartment_id', 'users.id', 'apartments.title')
            ->get(); // Execute query and get results
        
        $viewsCounts = DB::table('views')
        ->join('apartments', 'views.apartment_id', '=', 'apartments.id')
        ->join('users', 'apartments.user_id', '=', 'users.id')
        ->select(
            'apartments.title as apartment_name',
            DB::raw('CONCAT(users.name, " ", users.surname) as owner_name'),
            DB::raw('COUNT(views.id) as view_count')
        )
        ->where('apartments.user_id', $user->id)  // Ensure filtering by authenticated user's apartments
        ->groupBy('views.apartment_id', 'users.id', 'apartments.title')
        ->get(); // Execute query and get results
        // Return the dashboard view with the data
        return view('admin.dashboard', compact('messageCounts','viewsCounts','user','apartments'));
    }

}
