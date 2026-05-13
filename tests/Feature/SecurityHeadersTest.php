<?php

it('sets X-Frame-Options header on web responses', function (string $url): void {
    $response = $this->get($url);

    $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
})->with([
    '/admin/login',
    '/admin/forgot-password',
    '/publik/buletin',
    '/publik/kritik-saran',
]);

it('sets Content-Security-Policy frame-ancestors header on web responses', function (string $url): void {
    $response = $this->get($url);

    $response->assertHeader('Content-Security-Policy', "frame-ancestors 'self'");
})->with([
    '/admin/login',
    '/admin/forgot-password',
    '/publik/buletin',
    '/publik/kritik-saran',
]);
