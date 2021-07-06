<?php

namespace App\Http\Controllers;

use App\Models\History;
use Carbon\Carbon;

class StatsController extends Controller
{
    /**
     * Render the welcome view with the current stats.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('landing', [
            'sums' => $this->getHistorySums(),
            'stats' => [
                'minutes' => $this->getMinuteStats(),
                'hours' => $this->getHourStats(),
            ],
        ]);
    }

    /**
     * Get the sums of the requests made to the API, both total requests,
     * and the amount of requests made in the last month.
     *
     * @return array
     */
    protected function getHistorySums()
    {
        return app('cache')->remember('stats.sums', 60, function () {
            return [
                'total' => History::sum('last_minute'),
                'last_month' => History::where('created_at', '>', Carbon::now()->subMonth())->sum('last_minute'),
            ];
        });
    }

    /**
     * Get the minute history data for the last three hours.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getMinuteStats()
    {
        return app('cache')->remember('stats.minute', 60, function () {
            return $this->formatTimes(
                History::latest()
                    ->limit(180)
                    ->pluck('last_minute', 'created_at')
                    ->reverse()
            );
        });
    }

    /**
     * Get the hour history data for the last 7 days, with two records for each hour.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getHourStats()
    {
        return app('cache')->remember('stats.hour', 900, function () {
            return $this->formatTimes(
                History::latest()
                    ->limit(336)
                    ->where('last_hour', '>', 0)
                    ->pluck('last_hour', 'created_at')
                    ->reverse()
            );
        });
    }

    /**
     * Maps over the given collection, formatting the
     * keys into more human friendly date and times.
     *
     * @param \Illuminate\Support\Collection $collection
     * @return void
     */
    protected function formatTimes($collection)
    {
        return $collection->mapWithKeys(function ($value, $key) {
            $time = new Carbon($key);

            return [$time->rawFormat('M j, Y - H:i') => $value];
        });
    }
}
