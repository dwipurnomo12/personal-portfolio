<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AdminProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user();
        return view('admin.profile.index', [
            'profile'   => $profile
        ]);
    }


    public function update(Request $request, $id)
    {
        $profile = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'password'  => 'nullable|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $profile->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}