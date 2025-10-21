<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->session()->get('user');

        if (!$user) {
            return redirect()->route('login');
        }

        $foydalanuvchi = DB::table('malumoti_shakhsi')
            ->where('uid', $user['uid'])
            ->first();

        return view('profile.index', compact('foydalanuvchi'));
    }

    public function update(Request $request)
    {
        $user = $request->session()->get('user');

        $request->validate([
            'nom' => 'required|string|max:150',
            'nasab' => 'required|string|max:150',
            'surat' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nom' => $request->nom,
            'nasab' => $request->nasab,
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
