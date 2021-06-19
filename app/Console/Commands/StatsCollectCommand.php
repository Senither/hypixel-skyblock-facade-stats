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
        $url = config('facade.url');
        if ($url == null || \mb_strlen(trim($url)) == 0) {
            $this->warn('The facade URL have not been configured yet!');
            $this->warn('You must first set up the facade URL in the .env file');

            return 1;
        }

        $response = app(Factory::class)
            ->accept('application/json')
            ->withHeaders(['Authorization' => Str::uuid()->toString()])
            ->get(config('facade.url'));

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
