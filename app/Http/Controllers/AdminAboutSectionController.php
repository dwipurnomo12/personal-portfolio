<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminAboutSectionController extends Controller
{
    public function index()
    {
        $aboutSection = AboutSection::first();
        return view('admin.about-section.index', [
            'aboutSection'  => $aboutSection
        ]);
    }

    public function update(Request $request, String $id)
    {
        $aboutSection = AboutSection::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'about_image'   => 'nullable|mimes:jpg,png,jpeg,svg|max:2048',
            'cv'            => 'nullable|mimes:pdf',
            'description'   => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $image = $aboutSection->about_image;
        $pdf   = $aboutSection->cv;

        if ($request->hasFile('about_image') || $request->hasFile('cv')) {
            if ($request->hasFile('about_image') && $aboutSection->about_image) {
                Storage::disk('public')->delete($aboutSection->about_image);
                $image = $request->file('about_image')->store('about-image', 'public');
            }

            if ($request->hasFile('cv') && $aboutSection->cv) {
                Storage::disk('public')->delete($aboutSection->cv);
                $pdf = $request->file('cv')->store('file-cv', 'public');
            }
        }

        $aboutSection->update([
            'about_image'   => $image,
            'cv'            => $pdf,
            'description'   => $request->description
        ]);

        return redirect()->back()->with('success', 'Data updated successfully!');
    }
}