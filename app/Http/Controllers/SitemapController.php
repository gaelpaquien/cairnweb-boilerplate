<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Statamic\Facades\Entry;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $entries = Entry::query()->where('collection', 'pages')->get();

        $homeEntry = $entries->first(fn ($entry) => $entry->get('template') === 'pages/home');

        $urls = collect();

        $urls->push([
            'loc' => config('app.url'),
            'lastmod' => ($homeEntry?->lastModified() ?? now())->toDateString(),
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ]);

        $entries
            ->reject(fn ($entry) => $entry->get('template') === 'pages/home')
            ->each(function ($entry) use ($urls) {
                $urls->push([
                    'loc' => $entry->absoluteUrl(),
                    'lastmod' => $entry->lastModified()->toDateString(),
                    'changefreq' => 'yearly',
                    'priority' => '0.3',
                ]);
            });

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;

        foreach ($urls as $url) {
            $xml .= '  <url>'.PHP_EOL;
            $xml .= '    <loc>'.htmlspecialchars($url['loc']).'</loc>'.PHP_EOL;
            $xml .= '    <lastmod>'.$url['lastmod'].'</lastmod>'.PHP_EOL;
            $xml .= '    <changefreq>'.$url['changefreq'].'</changefreq>'.PHP_EOL;
            $xml .= '    <priority>'.$url['priority'].'</priority>'.PHP_EOL;
            $xml .= '  </url>'.PHP_EOL;
        }

        $xml .= '</urlset>';

        return response($xml)
            ->header('Content-Type', 'application/xml');
    }
}
