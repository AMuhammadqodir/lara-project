<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Rektor dashboard
    public function rector(Request $request)
    {
        $user = $request->session()->get('user');
        return view('dashboard.rector.rector', compact('user'));
    }

    // Admin dashboard
    public function admin(Request $request)
    {
        $user = $request->session()->get('user');
        $onlineCount = DB::table('malumoti_shakhsi')
            ->where('is_online', true)
            ->count();
        $userCount = DB::table('malumoti_shakhsi')->count();
        return view('dashboard.admin.admin', compact('user', 'onlineCount', 'userCount'));
    }

    public function getOnlineUsers()
    {
        // Onlayn foydalanuvchilarni olish
        $onlineUsers = DB::table('malumoti_shakhsi')
                        ->where('is_online', true)
                        ->get(['uid', 'login', 'nom', 'nasab', 'nomi_padar', 'surat']); // Foydalanuvchi ma'lumotlarini olish

        return response()->json($onlineUsers); // JSON formatida qaytarish
    }

    // Muallim dashboard
    public function muallim(Request $request)
    {
        $user = $request->session()->get('user');
        return view('dashboard.omuzgor.muallim', compact('user'));
    }

    // Donishju dashboard
    public function donishju(Request $request)
    {
        $user = $request->session()->get('user');
        return view('dashboard.donishju.donishju', compact('user'));
    }
}
