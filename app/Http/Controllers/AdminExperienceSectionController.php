<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExperienceSection;
use Illuminate\Support\Facades\Validator;

class AdminExperienceSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.experience-section.index');
    }

    /**
     * Get Data
     */
    public function getExperiences()
    {
        $experiences = ExperienceSection::orderBy('id', 'DESC')->get();
        return response()->json([
            'data'  => $experiences
        ]);
    }

    public function create()
    {
        return view('admin.experience-section.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_title'   => 'required',
            'company'     => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'is_current'  => 'boolean',
            'summary'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        ExperienceSection::create([
            'job_title'   => $request->job_title,
            'company'     => $request->company,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'is_current'  => $request->boolean('is_current'),
            'summary'     => $request->summary,
        ]);

        return response()->json(['message' => 'Experience added successfully.'], 201);
    }

    public function edit(string $id)
    {
        $experience = ExperienceSection::findOrFail($id);
        return response()->json([
            'success'   => true,
            'data' => $experience
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'job_title'   => 'required',
            'company'     => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'is_current'  => 'boolean',
            'summary'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $experience = ExperienceSection::findOrFail($id);
        $experience->update([
            'job_title'   => $request->job_title,
            'company'     => $request->company,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'is_current'  => $request->boolean('is_current'),
            'summary'     => $request->summary,
        ]);

        return response()->json(['message' => 'Experience updated successfully.'], 200);
    }

    public function destroy(string $id)
    {
        $experience = ExperienceSection::findOrFail($id);
        $experience->delete();

        return response()->json(['message' => 'Experience deleted successfully.'], 200);
    }
}
