<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use App\Models\ToolSection;
use App\Models\AboutSection;
use App\Models\SkillSection;
use Illuminate\Http\Request;
use App\Models\ProjectSection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
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

    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mailData = [
            'user_name'    => $request->name,
            'user_email'   => $request->email,
            'user_message' => $request->message,
        ];

        Mail::send('emails.contact', $mailData, function ($email) use ($request) {
            $email->to(env('MAIL_USERNAME'))
                ->subject('New Contact Message');
        });

        return response()->json([
            'success'   => true,
            'message'   => 'Email sent successfully!',
            'data'      => $mailData,
        ]);
    }
}