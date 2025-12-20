<?php

namespace App\Http\Controllers;

use App\Services\GoogleAnalyticsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(GoogleAnalyticsService $analytics)
    {
        $analyticsData = collect();
        $analyticsError = null;

        try {
            $analyticsData = $analytics->visitorsAndPageViews(14);
        } catch (\Throwable $exception) {
            $analyticsError = $exception->getMessage();
        }

        if ($analyticsData->isEmpty()) {
            $labels = collect(range(1, 14))
                ->map(fn($i) => now()->subDays(14 - $i)->format('M d'));

            $visitors = collect(array_fill(0, 14, 0));
            $pageViews = collect(array_fill(0, 14, 0));
        } else {
            $labels = $analyticsData->map(
                fn($row) =>
                $row['date']->format('M d')
            )->values();

            $visitors = $analyticsData->pluck('visitors')->values();
            $pageViews = $analyticsData->pluck('pageViews')->values();
        }

        return view('admin.index', [
            'labels' => $labels,
            'visitors' => $visitors,
            'pageViews' => $pageViews,
            'analyticsError' => $analyticsError,
        ]);
    }
}
