<?php


namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use SplFileInfo;
use App\Models\Region;
use App\Models\Municipality;

class ExportFileMetadataService
{
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
            'regions' => $this->metadata(File::allFiles("{$path}regions/"), Region::all(), 'regions'),
            'municipalities' => $this->metadata(File::allFiles("{$path}municipalities/"), Municipality::all(), 'municipalities')
        ];
    }

    private function metadata(array $data, Collection $collection, string $type): array
    {
        $collection = $collection->keyBy('id');
        return [
            ...array_map(function (SplFileInfo $file) use ($collection, $type) {
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