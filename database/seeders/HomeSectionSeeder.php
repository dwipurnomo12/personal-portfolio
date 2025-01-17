<?php

namespace Database\Seeders;

use App\Models\HomeSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeSection::create([
            'hero_image'        => '/hero-image/undraw_slider_8svk.svg',
            'title'             => 'Im Dwi Purnomo',
            'short_description' => 'A programmer with a passion for web programming, committed to creating innovative and user-friendly digital solutions. With expertise in web technology, I am ready to help you turn your ideas into reality through responsive design, high performance, and maximum functionality.'
        ]);
    }
}