<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\HomeSection;
use App\Models\ProjectSection;
use App\Models\SkillSection;
use App\Models\ToolSection;
use Illuminate\Http\Request;

class FrontendCoontroller extends Controller
{
    public function index()
    {
        $homeSection    = HomeSection::first();
        $aboutSection   = AboutSection::first();
        $skills         = SkillSection::orderBy('id', 'DESC')->get();
        $tools          = ToolSection::orderBy('id', 'DESC')->get();
        $projects       = ProjectSection::orderBy('id', 'DESC')->get();
        return view('index', [
            'homeSection'   => $homeSection,
            'aboutSection'  => $aboutSection,
            'skills'        => $skills,
            'tools'         => $tools,
            'projects'      => $projects
        ]);
    }
}