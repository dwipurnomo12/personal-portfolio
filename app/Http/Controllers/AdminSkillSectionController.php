<?php

namespace App\Http\Controllers;

use App\Models\SkillSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminSkillSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.skills-section.index');
    }

    /**
     * Get Data
     */
    public function getSkills()
    {
        $skills = SkillSection::orderBy('id', 'DESC')->get();
        return response()->json([
            'data'  => $skills
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skills-section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'skill_name'        => 'required|unique:skill_sections',
            'skill_logo'        => 'required|mimes:png,jpg,jpeg,svg|max:2048',
            'skill_description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $logo = null;
        if ($request->hasFile('skill_logo')) {
            $file     = $request->file('skill_logo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path     = $file->storeAs('skill-logo', $fileName, 'public');
            $logo     = $path;
        }

        $skill = SkillSection::create([
            'skill_logo'          => $logo,
            'skill_name'          => $request->skill_name,
            'skill_description'   => $request->skill_description
        ]);

        return response()->json([
            'success'   =>  'true',
            'message'   =>  'Data successfully added!',
            'data'      =>  $skill
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skill  = SkillSection::find($id);
        return response()->json([
            'success'   => true,
            'data'      => $skill
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $skill = SkillSection::find($id);
        $validator = Validator::make($request->all(), [
            'skill_name' => 'required|unique:skill_sections,skill_name,' . $skill->id,
            'skill_logo' => $request->hasFile('skill_logo')
                ? 'nullable|mimes:png,jpg,jpeg,svg|max:2048'
                : 'nullable',
            'skill_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $logo = $skill->skill_logo;
        if ($request->hasFile('skill_logo')) {
            $path      = 'skill-logo/';
            $file      = $request->file('skill_logo');
            $extension = $file->getClientOriginalExtension();
            $fileName  = uniqid() . '.' . $extension;
            $logo      = $file->storeAs($path, $fileName, 'public');

            if ($skill->skill_logo) {
                Storage::disk('public')->delete($skill->skill_logo);
            }
        }

        $skill->update([
            'skill_logo' => $logo,
            'skill_name' => $request->skill_name,
            'skill_description' => $request->skill_description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data updated successfully!',
            'data'    => $skill,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skill = SkillSection::find($id);
        if ($skill->skill_logo) {
            Storage::disk('public')->delete($skill->skill_logo);
        }
        $skill->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Data deleted successfully',
            'data'      => $skill,
        ]);
    }
}