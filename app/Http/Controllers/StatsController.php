<?php

namespace App\Http\Controllers;

use App\Models\History;

class StatsController extends Controller
{
    /**
     * Render the welcome view with the current stats.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('welcome', [
            'minutes' => $this->getMinuteStats(),
            'hours' => $this->getHourStats(),
        ]);
    }

    /**
     * Get the minute history data for the last hour.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getMinuteStats()
    {
        return app('cache')->remember('stats.minute', 60, function () {
            return History::latest()
                ->limit(3600)
                ->pluck('last_minute', 'created_at');
        });
    }

    /**
     * Get the hour history data for the last month, with two records for each hour.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getHourStats()
    {
        return app('cache')->remember('stats.hour', 900, function () {
            return History::latest()
                ->limit(1440)
                ->where('last_hour', '>', 0)
                ->pluck('last_hour', 'created_at');
        });
    }
}
