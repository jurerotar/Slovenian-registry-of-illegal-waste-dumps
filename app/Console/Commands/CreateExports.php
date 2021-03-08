<?php

namespace App\Console\Commands;

use App\Models\Municipality;
use App\Models\Region;
use App\Services\ExportDataService;
use Illuminate\Console\Command;

class CreateExports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exports:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates json files with dump data for regions and municipalities.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command. Creates a json file with dumps data for all regions and all municipalities.
     */
    public function handle()
    {

        $slugs = [
            ...Region::get(['slug'])->pluck('slug')->toArray(),
            ...Municipality::get(['slug'])->pluck('slug')->toArray(),
        ];

        foreach ($slugs as $slug) {
            $exportService = new ExportDataService($slug);
            $exportService->generate();
        }

        (new ExportDataService('skupno'))->generate();
    }
}
