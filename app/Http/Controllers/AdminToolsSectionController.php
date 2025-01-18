<?php

namespace App\Http\Controllers;

use App\Models\ToolSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminToolsSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tools-section.index');
    }

    /**
     * Get Data
     */
    public function getTools()
    {
        $tools = ToolSection::orderBy('id', 'DESC')->get();
        return response()->json([
            'data'  => $tools
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tools-section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tool_logo'     => 'required|mimes:png,jpg,jpeg,svg|max:2048',
            'tool_name'     => 'required|unique:tool_sections'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $logo = null;
        if ($request->hasFile('tool_logo')) {
            $file     = $request->file('tool_logo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path     = $file->storeAs('tool-logo', $fileName, 'public');
            $logo     = $path;
        }

        $tool = ToolSection::create([
            'tool_logo'     => $logo,
            'tool_name'     => $request->tool_name
        ]);

        return response()->json([
            'success'   =>  'true',
            'message'   =>  'Data successfully added!',
            'data'      =>  $tool
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tool = ToolSection::find($id);
        return response()->json([
            'success'   => true,
            'data'      => $tool
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tool = ToolSection::find($id);
        $validator = Validator::make($request->all(), [
            'tool_logo' => $request->hasFile('tool_logo')
                ? 'nullable|mimes:png,jpg,jpeg,svg|max:2048'
                : 'nullable',
            'tool_name'     => 'required|unique:tool_sections,tool_name,' . $tool->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $logo = $tool->tool_logo;
        if ($request->hasFile('tool_logo')) {
            $path      = 'tool-logo/';
            $file      = $request->file('tool_logo');
            $extension = $file->getClientOriginalExtension();
            $fileName  = uniqid() . '.' . $extension;
            $logo      = $file->storeAs($path, $fileName, 'public');

            if ($tool->tool_logo) {
                Storage::disk('public')->delete($tool->tool_logo);
            }
        }

        $tool->update([
            'tool_logo' => $logo,
            'tool_name' => $request->tool_name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data updated successfully!',
            'data'    => $tool,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tool = ToolSection::find($id);
        if ($tool->tool_logo) {
            Storage::disk('public')->delete($tool->tool_logo);
        }
        $tool->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Data deleted successfully',
            'data'      => $tool,
        ]);
    }
}