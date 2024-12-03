<?php

// namespace App\Http\Controllers\Admin;
// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class ViewController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $user = auth()->user();

//         // Ensure the user is authenticated
//         if (!$user) {
//             return redirect()->route('login');
//         }

//         // Query to fetch message counts for only the authenticated user's apartments
//         $viewsCounts = DB::table('views')
//             ->join('apartments', 'views.apartment_id', '=', 'apartments.id')
//             ->join('users', 'apartments.user_id', '=', 'users.id')
//             ->select(
//                 'apartments.title as apartment_name',
//                 DB::raw('CONCAT(users.name, " ", users.surname) as owner_name'),
//                 DB::raw('COUNT(views.id) as view_count')
//             )
//             ->where('apartments.user_id', $user->id)  // Ensure filtering by authenticated user's apartments
//             ->groupBy('views.apartment_id', 'users.id', 'apartments.title')
//             ->get(); // Execute query and get results

//         return view('view.index', compact('viewsCounts','user'));
//     }

// }
