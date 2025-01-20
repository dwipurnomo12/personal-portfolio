<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class AdminIntegrationsController extends Controller
{
    public function index()
    {
        return view('admin.integrations.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'google_verification' => 'required|string|max:255',
        ]);

        $envPath = base_path('.env');
        if (File::exists($envPath)) {
            $envContent = File::get($envPath);

            $key = 'GOOGLE_SEARCH_CONSOLE_VERIFICATION';
            $pattern = "/^{$key}=(.*)$/m";

            $newValue = "{$key}={$request->input('google_verification')}";

            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $newValue, $envContent);
            } else {
                $envContent .= "\n{$newValue}";
            }

            File::put($envPath, $envContent);
            Artisan::call('config:clear');

            return redirect()->back()->with('success', 'Google Search Console Verification updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update the .env file.');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'mail_host'     => 'required|string|max:255',
            'mail_host'     => 'required|string|max:255',
            'mail_port'     => 'required|string|max:255',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|max:255',
        ]);

        $envPath = base_path('.env');
        if (File::exists($envPath)) {
            $envContent = File::get($envPath);

            $mail_mailer     = 'MAIL_MAILER';
            $mail_host       = 'MAIL_HOST';
            $mail_port       = 'MAIL_PORT';
            $mail_username   = 'MAIL_USERNAME';
            $mail_password   = 'MAIL_PASSWORD';

            $pattern = "/^{$mail_mailer}=(.*)$/m";
            $pattern = "/^{$mail_host}=(.*)$/m";
            $pattern = "/^{$mail_port}=(.*)$/m";
            $pattern = "/^{$mail_username}=(.*)$/m";
            $pattern = "/^{$mail_password}=(.*)$/m";

            $newValue = "{$mail_mailer}={$request->input('mail_mailer')}";
            $newValue = "{$mail_host}={$request->input('mail_host')}";
            $newValue = "{$mail_port}={$request->input('mail_port')}";
            $newValue = "{$mail_username}={$request->input('mail_username')}";
            $newValue = "{$mail_password}={$request->input('mail_password')}";

            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $newValue, $envContent);
            } else {
                $envContent .= "\n{$newValue}";
            }

            File::put($envPath, $envContent);
            Artisan::call('config:clear');

            return redirect()->back()->with('success', 'Email verifications updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update the .env file.');
    }
}