<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\MalumotiShakhsi;

class UsersController extends Controller
{
    public function index()
    {
        $users = DB::table('malumoti_shakhsi as u')
        ->join('maqom as m', 'u.maqom_id', '=', 'm.maqom_id')
        ->join('malumotho as mm', 'm.namudi_maqom', '=', 'mm.id')
        ->select('u.uid', 'u.login', 'u.nom', 'u.nasab', 'u.nomi_padar', 'mm.tojiki as nomi_maqom', 'u.jins')
        ->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $maqom = DB::table('maqom as m')
        ->join('malumotho as mm', 'm.namudi_maqom', '=', 'mm.id')
        ->select('m.maqom_id', 'm.namudi_maqom', 'mm.tojiki as nomi_maqom')
        ->get();
        $s_nohiya = DB::table('shahr_nohiya')->get();
        return view('users.create', compact('maqom', 's_nohiya'));
    }

    // Foydalanuvchi qo‘shish
    public function store(Request $request)
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

        $hashedPassword = Hash::make($request->parol);

        MalumotiShakhsi::create([
            'nom' => $request->nom,
            'nasab' => $request->nasab,
            'nomi_padar' => $request->nomi_padar,
            'jins' => $request->jins,
            'shahr_nohiya' => $request->shahr_nohiya,
            'maqom_id' => $request->maqom_id,
            'parol' => $hashedPassword,
            'aktiv' => 1,
        ]);

        return redirect()->route('users.index')->with('success', 'Foydalanuvchi muvaffaqiyatli qo‘shildi!');
    }

    // Tahrirlash sahifasi
    public function edit($id)
    {
        $user = MalumotiShakhsi::findOrFail($id);
        $maqom = DB::table('maqom as m')
        ->join('malumotho as mm', 'm.namudi_maqom', '=', 'mm.id')
        ->select('m.maqom_id', 'm.namudi_maqom', 'mm.tojiki as nomi_maqom')
        ->get();
        $s_nohiya = DB::table('shahr_nohiya')->get();
        return view('users.edit', compact('user', 'maqom', 's_nohiya'));
    }

    // Foydalanuvchini yangilash
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:150',
            'nasab' => 'required|string|max:150',
            'nomi_padar' => 'nullable|string|max:150',
            'jins' => 'required|in:Мард,Зан',
            'shahr_nohiya' => 'required|integer',
            'maqom_id' => 'required|integer',
            'parol' => 'nullable|string|min:6|confirmed',
        ]);

        $user = MalumotiShakhsi::findOrFail($id);

        $user->update([
            'nom' => $request->nom,
            'nasab' => $request->nasab,
            'nomi_padar' => $request->nomi_padar,
            'jins' => $request->jins,
            'shahr_nohiya' => $request->shahr_nohiya,
            'maqom_id' => $request->maqom_id,
            'parol' => $request->parol ? Hash::make($request->parol) : $user->parol,
        ]);

        return redirect()->route('users.index')->with('success', 'Foydalanuvchi muvaffaqiyatli yangilandi!');
    }

    // Foydalanuvchini o‘chirish
    public function destroy($id)
    {
        $user = MalumotiShakhsi::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Foydalanuvchi o‘chirildi!');
    }
}
