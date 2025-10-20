<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MalumotiShakhsi;
use App\Models\MalumotParol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        $shahr_nohiya = DB::table('shahr_nohiya')->get();
        $maqom = DB::table('maqom as q')
        ->join('malumotho as m', 'q.namudi_maqom', '=', 'm.id')
        ->select('q.maqom_id', 'm.tojiki')
        ->get();

        return view('auth.register', compact('shahr_nohiya', 'maqom'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:150',
            'nasab' => 'required|string|max:150',
            'nomi_padar' => 'nullable|string|max:150',
            'jins' => 'required|in:Мард,Зан',
            'shahr_nohiya' => 'required|integer',
            'maqom_id' => 'required|integer',
            'parol' => 'required|string|min:6|confirmed',
        ]);

        $user = MalumotiShakhsi::ilova_istifodabar([
            'nom' => $request->nom,
            'nasab' => $request->nasab,
            'nomi_padar' => $request->nomi_padar,
            'jins' => $request->jins,
            'shahr_nohiya' => $request->shahr_nohiya,
            'maqom_id' => $request->maqom_id,
            'parol' => $request->parol,
        ]);

        MalumotParol::create([
            'uid' => $user->uid,
            'login' => $user->login,
            'parol' => $request->parol,
        ]);

        return redirect()->route('login')->with('success', "Аз рӯйхат бомуваффақият гузашт: {$user->login}");
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'parol' => 'required|string',
        ]);

        $user = MalumotiShakhsi::where('login', $request->login)->first();

        if ($user && Hash::check($request->parol, $user->parol)) {
            session(['user' => $user]);
            return redirect()->route('dashboard')->with('success', 'Хуш омадед!');
        }

        return back()->withErrors(['login' => 'Логин ё парол нодуруст аст!']);
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }
}
