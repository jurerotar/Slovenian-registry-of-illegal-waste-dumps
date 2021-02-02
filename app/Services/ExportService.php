<?php


namespace App\Services;

use App\Models\Dump;
use App\Traits\ExportFileNameTrait;
use App\Traits\RawSqlExportQueriesTrait;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ExportService
{
    use ExportFileNameTrait, RawSqlExportQueriesTrait;

    private Filesystem $disk;
    private string $type;
    private int $id;
    private string $path;

    public function __construct(string $type, int $id)
    {
        $this->disk = Storage::disk('local');
        $this->type = $type;
        $this->id = $id;
        $this->path = "public/{$type}/{$id}.json";
    }

    /**
     * Make 2 separate queries, since dump->comments is a one to many relationship. Join the results and pass it to
     * transform service, which returns json.
     */
    public function generate()
    {
        $dumps = $this->dumpsByRegionOrMunicipality($this->type === 'municipalities' ? $this->id : 0, $this->type === 'regions' ? $this->id : 0);
        $comments = $this->commentsByRegionOrMunicipality($this->type === 'municipalities' ? $this->id : 0, $this->type === 'regions' ? $this->id : 0);
        foreach ($dumps as &$dump) {
            $dump['comments'] = [];
            foreach ($comments as $comment) {
                if ($dump['id'] === $comment['id']) {
                    $dump['comments'][] = [
                        'comment' => $comment['comment'],
                        'created_at' => $comment['created_at']
                    ];
                    continue;
                }
            }
        }
        $json = ExportTransformService::toJson($dumps);
        $this->export($json);

    }

    /**
     * Dumps the file in specified storage path
     * @param string $json - data to dump
     */
    private function export(string $json): void
    {
        $this->disk->put($this->path, $json);
    }

    /**
     * Method checks if json file already in storage needs to be updated with updated data from database.
     * @param string $type
     * @param int $id
     * @returns bool
     */
    public function needsUpdating(): bool
    {
        if (!$this->disk->exists($this->path)) {
            return true;
        }
        $lastUpdated = Carbon::createFromTimestamp($this->disk->lastModified($this->path));
        return Dump::whereHas($this->type === 'regions' ? 'region' : 'municipality', function ($e) {
                $e->where('id', '=', $this->id);
            })
                ->whereDate('updated_at', '>', $lastUpdated)
                ->count() !== 0;
    }
}
