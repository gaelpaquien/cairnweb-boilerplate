<?php

namespace App\Support;

class Url
{
    /**
     * Resolve an anchor href so on-page anchors (#contact) work from sub-pages
     * by redirecting to homepage + scroll target.
     */
    public static function anchor(string $href): string
    {
        if (! str_starts_with($href, '#')) {
            return $href;
        }

        return request()->is('/') ? $href : '/'.$href;
    }
}
