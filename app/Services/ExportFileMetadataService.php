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
        $path = storage_path('app/public/');

        $total = [
            'id' => 0,
            'name' => 'Skupno',
            'extension' => 'json',
            'last_modified' => File::lastModified("{$path}total.json"),
            'size' => File::size("{$path}total.json"),
            'type' => null
        ];

        return [
            'total' => $total,
            'regions' => $this->metadata(File::allFiles("{$path}regions/"), $this->cache->regions(), 'regions'),
            'municipalities' => $this->metadata(File::allFiles("{$path}municipalities/"), $this->cache->municipalities(), 'municipalities')
        ];
    }

    private function metadata(array $data, Collection $collection, string $type): array
    {
        $collection = $collection->keyBy('id');
        return [
            ...array_map(function (SplFileInfo $file) use ($collection, $type): array {
                $id = (int)str_replace(".{$file->getExtension()}", '', $file->getFilename());
                return [
                    'id' => $id,
                    'name' => $collection->get($id)->name,
                    'last_modified' => $file->getMTime(),
                    'size' => $file->getSize(),
                    'extension' => $file->getExtension(),
                    'type' => $type
                ];
            }, $data)
        ];
    }
}
