<?php

namespace App\Console\Commands;

use App\Models\History;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class StatsCollectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:collect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect history stats from the public API.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = app(Factory::class)
            ->accept('application/json')
            ->withHeaders(['Authorization' => Str::uuid()->toString()])
            ->get('https://hypixel-api.senither.com/v1/stats');

        if ($response->status() !== 200) {
            $this->warn('API responded with a non-success status code, skipping logging.');

            return 1;
        }

        $data = \json_decode((string) $response->getBody())->data;

        History::create([
            'last_minute' => $data->requests->last_minute,
            'last_hour' => app(Carbon::class)->minute % 30 == 0
                ? $data->requests->last_hour : 0,
        ]);

        $this->info('Current stats have been collected and saved.');

        return 0;
    }
}
