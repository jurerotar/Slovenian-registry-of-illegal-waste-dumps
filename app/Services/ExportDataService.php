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
    private CacheService $cache;
    private string|null $type;
    private int|null $id;

    public function __construct(
        private string $slug
    )
    {
        $this->disk = Storage::disk('public');
        $this->cache = new CacheService();
        $this->type = $this->type($slug);
        $this->id = $this->id($this->type, $this->slug);
    }

    /**
     * Make 2 separate queries, since dump->comments is a one to many relationship. Join the results and pass it to
     * transform service, which returns json.
     */
    public function generate()
    {
        $regions = $this->cache->regions();
        $municipalities = $this->cache->municipalities();
        $dumps = $this->dumpsByRegionOrMunicipality($this->type, $this->id);
        $comments = $this->commentsByRegionOrMunicipality($this->type, $this->id);
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
                    continue;
                }
            }
        }
        $name = 'skupno';

        if ($this->type && $this->id) {
            $name = ($this->type === 'regions') ? $regions->find($this->id)->slug : $municipalities->find($this->id)->slug;
        }

        $json = ExportTransformService::toJson($dumps);
        $this->disk->put("{$name}.json", $json);
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
        if (!$this->disk->exists("{$this->slug}.json")) {
            return true;
        }
        $lastUpdated = Carbon::createFromTimestamp($this->disk->lastModified("{$this->slug}.json"));
        $query = Dump::query();
        if ($this->type && $this->id) {
            $query->whereHas("{$this->type}", fn($e) => $e->whereId($this->id));
        }
        return $query->whereDate('updated_at', '>', $lastUpdated)
                ->count() !== 0;
    }

    private function type(string $slug): string|null
    {
        $regions = $this->cache->regions()->pluck('slug')->all();
        $municipalities = $this->cache->municipalities()->pluck('slug')->all();
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
            return $this->cache->regions()->where('slug', $slug)->first()->id;
        } else if ($type === 'municipalities') {
            return $this->cache->municipalities()->where('slug', $slug)->first()->id;
        }

    }
}
