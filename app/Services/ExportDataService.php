<?php


namespace App\Services;

use App\Models\Dump;
use App\Traits\RawSqlExportQueriesTrait;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ExportDataService
{
    use RawSqlExportQueriesTrait;

    private Filesystem $disk;
    private string|null $type;
    private int|null $id;

    public function __construct(
        private string $slug
    )
    {
        $this->disk = Storage::disk('public');
        $this->type = $this->type($slug);
        $this->id = $this->id($this->type, $this->slug);
    }

    /**
     * Make 2 separate queries, since dump->comments is a one to many relationship. Join the results and pass it to
     * transform service, which returns json.
     */
    public function generate()
    {
        $regions = AppCache::regions();
        $municipalities = AppCache::municipalities();
        $dumps = $this->dumpsByRegionOrMunicipality(type: $this->type, id: $this->id);
        $comments = $this->commentsByRegionOrMunicipality(type: $this->type, id: $this->id);
        /**
         * Add comments to dumps
         */
        foreach ($dumps as &$dump) {
            $dump['comments'] = [];
            foreach ($comments as $comment) {
                if ($dump['id'] === $comment['id']) {
                    $dump['comments'][] = [
                        'comment' => $comment['comment'],
                        'created_at' => $comment['created_at'],
                    ];
                }
            }
        }
        $name = 'skupno';

        if ($this->type && $this->id) {
            $name = ($this->type === 'regions') ? $regions->find(key: $this->id)->slug : $municipalities->find(key: $this->id)->slug;
        }

        $json = ExportTransformService::toJson(result: $dumps);
        $this->disk->put(path: "{$name}.json", contents: $json);
    }

    private function dumps(string $type, int $id)
    {
        // TODO: rewrite dumpsByRegionOrMunicipality in eloquent
    }

    private function comments(string $type, int $id)
    {
        // TODO: rewrite dumpsByRegionOrMunicipality in eloquent
    }

    /**
     * Method checks if json file already in storage needs to be updated with updated data from database.
     * @return bool
     */
    public function needsUpdating(): bool
    {
        if (!$this->disk->exists(path: "{$this->slug}.json")) {
            return true;
        }
        $lastUpdated = Carbon::createFromTimestamp(timestamp: $this->disk->lastModified(path: "{$this->slug}.json"));
        $query = Dump::query();
        if ($this->type && $this->id) {
            $query->whereHas(relation: "{$this->type}", callback: fn($e) => $e->whereId($this->id));
        }
        return $query->whereDate(column: 'updated_at', operator:'>', value: $lastUpdated)
                ->count() !== 0;
    }

    private function type(string $slug): string|null
    {
        $regions = AppCache::regions()->pluck('slug')->all();
        $municipalities = AppCache::municipalities()->pluck('slug')->all();
        if (in_array($slug, $regions)) {
            return 'regions';
        } else if (in_array($slug, $municipalities)) {
            return 'municipalities';
        }
        return null;
    }

    private function id(string|null $type, string $slug): int|null
    {
        if ($type === null) {
            return null;
        }

        if ($type === 'regions') {
            return AppCache::regions()->where(key: 'slug', operator: '=', value: $slug)->first()->id;
        } else if ($type === 'municipalities') {
            return AppCache::municipalities()->where(key: 'slug', operator: '=', value: $slug)->first()->id;
        }

    }
}
