<?php


namespace App\Services;

use App\Models\Dump;
use App\Traits\ExportFileNameTrait;
use App\Traits\RawSqlExportQueriesTrait;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ExportDataService
{
    use ExportFileNameTrait, RawSqlExportQueriesTrait;

    private Filesystem $disk;

    public function __construct()
    {
        $this->disk = Storage::disk('local');
    }

    /**
     * Make 2 separate queries, since dump->comments is a one to many relationship. Join the results and pass it to
     * transform service, which returns json.
     * @param null $type
     * @param null $id
     */
    public function generate($type = null, $id = null)
    {
        $dumps = $this->dumpsByRegionOrMunicipality($type, $id);
        $comments = $this->commentsByRegionOrMunicipality($type, $id);
        /**
         * Add comments to dumps
         */
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
        $path = ($type && $id) ? "public/{$type}/{$id}.json" : 'public/total.json';

        $json = ExportTransformService::toJson($dumps);
        $this->export($json, $path);
    }

    /**
     * Writes file to path
     * @param string $data
     * @param string $path
     */
    private function export(string $data, string $path): void
    {
        $this->disk->put($path, $data);
    }

    /**
     * Method checks if json file already in storage needs to be updated with updated data from database.
     * @param string|null $type
     * @param int|null $id
     * @return bool
     */
    public function needsUpdating(string|null $type = null, int|null $id = null): bool
    {
        $path = ($type && $id) ? "public/{$type}/{$id}.json" : 'public/total.json';

        if (!$this->disk->exists($path)) {
            return true;
        }
        $lastUpdated = Carbon::createFromTimestamp($this->disk->lastModified($path));
        $query = Dump::query();
        if ($type && $id) {
            $query->whereHas("{$type}", fn($e) => $e->whereId($id));
        }
        return $query->whereDate('updated_at', '>', $lastUpdated)
                ->count() !== 0;
    }
}
