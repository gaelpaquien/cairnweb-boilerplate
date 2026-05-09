<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', SitemapController::class);

Route::get('/robots.txt', function () {
    $sitemap = rtrim((string) config('app.url'), '/').'/sitemap.xml';

    $body = <<<TXT
User-agent: *
Allow: /
Disallow: /cp/
Disallow: /vendor/

Sitemap: {$sitemap}
TXT;

    return response($body)->header('Content-Type', 'text/plain');
});

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('contact.store');
