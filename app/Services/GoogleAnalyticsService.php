<?php

namespace App\Services;

use Spatie\Analytics\Analytics;
use Spatie\Analytics\AnalyticsClientFactory;
use Spatie\Analytics\Period;

class GoogleAnalyticsService
{
    /** @var Analytics */
    protected Analytics $analytics;

    public function __construct()
    {
        $client = AnalyticsClientFactory::createForConfig(
            config('analytics')
        );

        $this->analytics = new Analytics(
            $client,
            config('analytics.property_id')
        );
    }

    public function visitorsAndPageViews(int $days = 7)
    {
        return $this->analytics->fetchTotalVisitorsAndPageViews(
            Period::days($days)
        )->map(function (array $row): array {
            return [
                'date' => $row['date'] ?? null,
                'visitors' => $row['activeUsers'] ?? 0,
                'pageViews' => $row['screenPageViews'] ?? 0,
            ];
        });
    }

    public function byDevice(int $days = 30)
    {
        return $this->analytics->get(
            Period::days($days),
            ['sessions'],
            ['deviceCategory']
        );
    }

    public function byCountry(int $days = 30)
    {
        return $this->analytics->get(
            Period::days($days),
            ['sessions'],
            ['country']
        );
    }

    public function byBrowser(int $days = 30)
    {
        return $this->analytics->get(
            Period::days($days),
            ['sessions'],
            ['browser']
        );
    }
}
