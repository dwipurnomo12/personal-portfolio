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
            $labels = $analyticsData->values()->map(function ($row, $index) use ($analyticsData) {
                $date = data_get($row, 'date');
                if ($date instanceof \Carbon\CarbonInterface) {
                    return $date->format('M d');
                }

                if (is_string($date) && $date !== '') {
                    return \Carbon\Carbon::parse($date)->format('M d');
                }

                // Fallback to a computed label when the date key is missing.
                $daysBack = $analyticsData->count() - 1 - $index;
                return now()->subDays($daysBack)->format('M d');
            })->values();

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
