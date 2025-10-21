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
            'surat' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'shahr_nohiya' => 'required|integer',
            'maqom_id' => 'required|integer',
            'parol' => 'required|string|min:6|confirmed',
        ]);
        $surat = null;
        if ($request->hasFile('surat')) {
            $file = $request->file('surat');
            $surat = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/suratho'), $surat);
            $path = 'uploads/suratho/' . $surat;
        }

        $user = MalumotiShakhsi::ilova_istifodabar([
            'nom' => $request->nom,
            'nasab' => $request->nasab,
            'nomi_padar' => $request->nomi_padar,
            'jins' => $request->jins,
            'shahr_nohiya' => $request->shahr_nohiya,
            'maqom_id' => $request->maqom_id,
            'parol' => $request->parol,
            'surat' => $path,
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

        $user = DB::table('malumoti_shakhsi')
            ->where('login', $request->login)
            ->first();

        if ($user && Hash::check($request->parol, $user->parol)) {
            // Foydalanuvchi sessionga saqlash
            $request->session()->put('user', [
                'uid' => $user->uid,
                'login' => $user->login,
                'nom' => $user->nom,
                'nasab' => $user->nasab,
                'jins' => $user->jins,
                'surat' => $user->surat ?? 'dist/nobody.jpg',
                'shahr_nohiya' => $user->shahr_nohiya,
                'maqom_id' => $user->maqom_id,
            ]);

            DB::table('malumoti_shakhsi')
            ->where('uid', $user->uid)
            ->update(['is_online' => true]);

            // Maqomga qarab yo'naltirish
            switch ($user->maqom_id) {
                case 1: return redirect()->route('maqom.rector');       // Rector
                case 2: return redirect()->route('maqom.admin');     // Admin
                case 3: return redirect()->route('maqom.muallim');   // Muallim
                case 4: return redirect()->route('maqom.donishju');  // Donishju
                default: return redirect()->route('dashboard');
            }
        }

        return back()->withErrors(['login' => 'Логин ё парол нодуруст аст!']);
    }


    public function logout()
    {
        $user = session('user');
        if ($user) {
            DB::table('malumoti_shakhsi')
                ->where('uid', $user['uid'])
                ->update(['is_online' => false]);
        }
        session()->forget('user');
        return redirect()->route('login');
    }

}
