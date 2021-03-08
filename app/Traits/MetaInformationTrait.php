<?php


namespace App\Traits;


trait MetaInformationTrait
{
    public function declineDescription(string $name): string
    {
        if ($name === 'Jugovzhodna Slovenija') {
            return 'Jugovzhodno Slovenski';
        }
        return str_replace('ka', 'ki', $name);
    }
}
