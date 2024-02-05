<?php

namespace App\Observer\Crawler;

use App\Services\PageCrawlerService;
use Spatie\Crawler\CrawlObservers\CrawlObserver;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class CrawlerObserver extends CrawlObserver
{
    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void {
        PageCrawlerService::save(
            $url,
            $response->getBody()->__toString()
        );
    }
}
