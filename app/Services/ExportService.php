<?php


namespace App\Services;

use App\Models\Dump;
use App\Models\Location;
use App\Traits\ExportFileNameTrait;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ExportService
{
    use ExportFileNameTrait;

    private Carbon $yesterday;
    private Filesystem $disk;


    public function __construct()
    {
        $this->yesterday = now()->subDay();
        $this->disk = Storage::disk('local');
    }

    /**
     * Fetch ids of regions and municipalities that were updated in the last $this->updatedSince days
     * For each region check if file already exists and when it was created. If it doesn't exist or
     * if it was created before our $this->updatedSince, its not updated with new info and needs to be replaced
     */
    public function update(): void
    {
        $types = [
            'region' => 'regions/',
            'municipality' => 'municipalities/'
        ];

        foreach ($types as $table => $path) {
            $lastUpdatedIds = $this->lastUpdated($table);
            foreach ($lastUpdatedIds as $id) {
                if (!$this->isFileValid($path . $id . '.json')) {
                    $this->generate($id, $table, $path);
                }
            }
        }
    }

    private function generate(int $id, string $table, string $path): void
    {
        $dumps = Location::with('dump', $table)
            ->where($table . '_id', $id)
            ->get()->pluck('dump')->toJson();

        $this->export($id, $dumps, $path);
    }

    private function isFileValid(string $path): bool
    {
        return $this->disk->exists($path) && $this->disk->lastModified($path) >= $this->yesterday->timestamp;
    }

    private function export(string $name, string $json, string $path): void
    {
        $this->disk->put($path . $this->name($name), $json);
    }

    private function lastUpdated(string $table): array
    {
        return Dump::with($table)
            ->where('updated_at', '>', $this->yesterday->toDateString())
            ->get()
            ->pluck($table)
            ->pluck('id')
            ->unique()
            ->toArray();
    }
}
