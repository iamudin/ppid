<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3Config
{
    public function item(string $item, string $index = '')
    {
        $app = config('App');
        return $app->{$item} ?? null;
    }

    public function set_item(string $item, $value): void
    {
        $app = config('App');
        $app->{$item} = $value;
    }

    public function base_url(string $uri = '', ?string $protocol = null): string
    {
        return base_url($uri);
    }

    public function site_url(string $uri = '', ?string $protocol = null): string
    {
        return site_url($uri);
    }
}
