<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->session()->get('user');

        if (!$user) {
            return redirect()->route('login');
        }

        $ist = DB::table('malumoti_shakhsi')
            ->where('uid', $user['uid'])
            ->first();
        $maqom = DB::table('maqom as m')
        ->join('malumotho as mm', 'm.namudi_maqom', '=', 'mm.id')
        ->select('m.maqom_id', 'm.namudi_maqom', 'mm.tojiki as nomi_maqom')
        ->get();
        $s_nohiya = DB::table('shahr_nohiya')->get();

        return view('profile.index', compact('ist', 's_nohiya', 'maqom'));
    }

    public function update(Request $request)
    {
        $user = $request->session()->get('user');

        $request->validate([
            'nom' => 'required|string|max:150',
            'nasab' => 'required|string|max:150',
            'nomi_padar' => 'nullable|string|max:150',
            'jins' => 'required|in:Мард,Зан',
            'shahr_nohiya' => 'required|integer',
            'maqom_id' => 'required|integer',
            'parol' => 'nullable|string|min:6|confirmed',
            'surat' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $hashedPassword = Hash::make($request->parol);
        $data = [
            'nom' => $request->nom,
            'nasab' => $request->nasab,
            'nomi_padar' => $request->nomi_padar,
            'jins' => $request->jins,
            'shahr_nohiya' => $request->shahr_nohiya,
            'maqom_id' => $request->maqom_id,
            'parol' => $hashedPassword,
            'aktiv' => 1,
        ];

        if ($request->hasFile('surat')) {
            $file = $request->file('surat');
            $filename = 'surat' . $user['uid'] . '.' . $file->getClientOriginalExtension();
            $path = $file->move(public_path('uploads/suratho'), $filename);
            $data['surat'] = 'uploads/suratho/' . $filename;
        }

        DB::table('malumoti_shakhsi')->where('uid', $user['uid'])->update($data);

        // Sessiondagi user ma’lumotlarini ham yangilaymiz
        $updatedUser = array_merge($user, $data);
        $request->session()->put('user', $updatedUser);

        return back()->with('success', 'Маълумот муваффақиятли янгиланди!');
    }
}
