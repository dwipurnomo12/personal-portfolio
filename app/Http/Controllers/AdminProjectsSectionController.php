<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectSection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class AdminProjectsSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects-section.index');
    }

    /**
     * Get Data
     */
    public function getProjects()
    {
        $projects = ProjectSection::orderBy('id', 'DESC')->get();
        return response()->json([
            'data'  => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects-section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'featured_image'        => 'required|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'project_name'          => 'required|unique:project_sections',
            'project_description'   => 'required',
            'url_preview'           => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = null;
        if ($request->hasFile('featured_image')) {
            $file     = $request->file('featured_image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path     = $file->storeAs('project-image', $fileName, 'public');
            $image     = $path;
        }

        $project = ProjectSection::create([
            'featured_image'        => $image,
            'project_name'          => $request->project_name,
            'url_preview'           => $request->url_preview,
            'project_description'   => $request->project_description
        ]);

        return response()->json([
            'success'   =>  'true',
            'message'   =>  'Data successfully added!',
            'data'      =>  $project
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = ProjectSection::find($id);
        return response()->json([
            'success'   => true,
            'data'      => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = ProjectSection::find($id);
        return response()->json([
            'success'   => true,
            'data'      => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = ProjectSection::find($id);
        $validator = Validator::make($request->all(), [
            'featured_image'        => $request->hasFile('featured_image') ? 'nullable|mimes:png,jpg,jpeg,svg,webp|max:2048' : 'nullable',
            'project_name'          => 'required|unique:project_sections,project_name,' . $project->id,
            'project_description'   => 'required',
            'url_preview'           => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $gambar = $project->featured_image;
        if ($request->hasFile('featured_image')) {
            $path      = 'project-image/';
            $file      = $request->file('featured_image');
            $extension = $file->getClientOriginalExtension();
            $fileName  = uniqid() . '.' . $extension;
            $gambar    = $file->storeAs($path, $fileName, 'public');

            if ($project->featured_image) {
                Storage::disk('public')->delete($project->featured_image);
            }
        }

        $project->update([
            'featured_image'        => $gambar,
            'project_name'          => $request->project_name,
            'url_preview'           => $request->url_preview,
            'project_description'   => $request->project_description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data updated successfully!',
            'data'    => $project,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = ProjectSection::find($id);
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }
        $project->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Data deleted successfully',
            'data'      => $project,
        ]);
    }
}