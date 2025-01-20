<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generate()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setLastModificationDate(now()));

        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json(['message' => 'Sitemap generated successfully']);
    }
}