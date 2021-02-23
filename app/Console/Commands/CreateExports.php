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

        $types = [
            'municipalities' => range(1, Municipality::count()),
            'regions' => range(1, Region::count())
        ];
        $exportService = new ExportDataService();

        foreach ($types as $type => $ids) {
            foreach ($ids as $id) {
                $exportService->generate($type, $id);
            }
        }

        /**
         * Generate total.json, which contains database dump.
         */
        $exportService->generate();
    }
}
