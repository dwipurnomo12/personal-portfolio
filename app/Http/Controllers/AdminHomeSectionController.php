<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminHomeSectionController extends Controller
{
    public function index()
    {
        $homeSection = HomeSection::first();
        return view('admin.home-section.index', [
            'homeSection'   => $homeSection
        ]);
    }

    public function update(Request $request, String $id)
    {
        $homeSection = HomeSection::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'hero_image'        => 'nullable|mimes:jpg,png,jpeg,svg|max:2048',
            'title'             => 'required|max:255',
            'short_description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $image = $homeSection->hero_image;
        if ($request->hasFile('hero_image')) {
            if ($homeSection->hero_image) {
                Storage::disk('public')->delete($homeSection->hero_image);
            }
            $image = $request->file('hero_image')->store('hero-image', 'public');
        }

        $homeSection->update([
            'hero_image'        => $image,
            'title'             => $request->title,
            'short_description' => $request->short_description
        ]);

        return redirect()->back()->with('success', 'Data updated successfully!');
    }
}