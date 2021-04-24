<?php


namespace App\Helpers;


use Inertia\Inertia;
use Inertia\Response;

class InertiaHelper
{
    public static function serverRender(string $component, array $props): Response
    {
        $lowercaseName = strtolower($component);
        $meta = [
            'title' => __("meta.{$lowercaseName}.title"),
            'description' => __("meta.{$lowercaseName}.description"),
            'page_name' => $lowercaseName,
        ];
        return Inertia::render($component, ['meta' => $meta] + $props)->withViewData($meta);
    }
}

