<?php

namespace App\Services;

use App\Models\Municipality;
use App\Models\Region;
use JetBrains\PhpStorm\ArrayShape;

class ViewMetadataService
{
    #[ArrayShape([
        "title" => "string",
        'description' => "string",
    ])]
    public function __invoke(string $view, Region|Municipality $model = null): array
    {
        $slogan = __("views_meta_data.slogan");

        $path = join('.', array_map(
            fn(string $el): string => strtolower(preg_replace('/(?<!^)([A-Z])/', '_\\1', $el)),
            explode('/', $view)
        ));

        $replaces = $model ? ['name' => $model->name] : [];

        return [
            "title" => __(
                "views_meta_data.views.$path.title", $replaces) . ' | ' . $slogan,
            'description' => __("views_meta_data.views.$path.description", $replaces),
        ];
    }
}
