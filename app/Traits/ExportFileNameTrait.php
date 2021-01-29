<?php

namespace App\Traits;

trait ExportFileNameTrait
{

    public function dateName(string $name, string $extension = 'json'): string
    {
        return $this->replaces(now()->format('Y_m_d') . '_' . $name . '.' . $extension);
    }

    public function name(string $name, string $extension = 'json'): string
    {
        return $this->replaces($name . '.' . $extension);
    }

    private function replaces(string $name): string
    {
        return strtr($name, [
            ' ' => '_',
            '-' => '_'
        ]);
    }
}
