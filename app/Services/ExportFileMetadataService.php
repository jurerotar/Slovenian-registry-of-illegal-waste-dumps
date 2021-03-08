<?php


namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use SplFileInfo;

class ExportFileMetadataService
{

    private CacheService $cache;

    public function __construct()
    {
        $this->cache = new CacheService();
    }

    public function get(): array
    {
        $path = public_path('download');

        $total = [
            'id' => 0,
            'name' => 'Skupno',
            'extension' => 'json',
            'last_modified' => File::lastModified('download/skupno.json'),
            'size' => File::size('download/skupno.json'),
            'type' => '/',
            'slug' => 'skupno',
            'url' => asset('download/skupno.json'),

        ];
        $regions = $this->cache->regions()->keyBy('slug');
        $municipalities = $this->cache->municipalities()->keyBy('slug');
        $data = $regions->toBase()->merge($municipalities);
        return [
            'total' => $total,
            'specific' => $this->metadata($this->removeTotal(File::files($path)), $data),
        ];
    }

    private function metadata(array $data, Collection $collection): array
    {
        return [
            ...array_map(function (SplFileInfo $file) use ($collection): array {
                $slug = str_replace(".{$file->getExtension()}", '', $file->getFilename());
                return [
                    'id' => $collection->get($slug)->id,
                    'name' => $collection->get($slug)->name,
                    'last_modified' => $file->getMTime(),
                    'size' => $file->getSize(),
                    'extension' => $file->getExtension(),
                    'slug' => $slug,
                    'url' => asset("download/{$slug}.json"),
                ];
            }, $data),
        ];
    }

    private function removeTotal($array): array
    {
        foreach ($array as $key => $object) {
            if ($object->getFilename() === 'skupno.json') {
                unset($array[$key]);
            }
        }
        return $array;
    }
}
