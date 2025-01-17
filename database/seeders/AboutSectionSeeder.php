<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutSection::create([
            'about_image'   => '/about-image/dwi_purnomo.png',
            'cv'            => '/file-cv/cv.pdf',
            'description'   => 'My name is Dwi Purnomo, a Bachelor of Information Technology graduate from Muhammadiyah University of Purworejo. I have a great interest in the world of technology, especially in web development. So far, I have developed several websites designed to meet user needs with a focus on responsive design, performance, and optimal user experience. I always try to continue learning and following the latest technological developments in order to provide the best solutions in every project I work on. With a combination of academic knowledge and practical experience, I am ready to help make your digital ideas a reality.'
        ]);
    }
}