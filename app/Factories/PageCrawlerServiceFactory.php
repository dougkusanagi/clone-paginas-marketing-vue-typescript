<?php

namespace App\Factories;

use App\Services\PageCrawlerService;
use Spatie\Crawler\Crawler;
use App\Observer\Crawler\CrawlerObserver;

class PageCrawlerServiceFactory
{
    public static function create(): PageCrawlerService
    {
        return (new PageCrawlerService(
            Crawler::create()
                ->setCrawlObserver(new CrawlerObserver())
                ->setMaximumDepth(0)
        ));
    }
}
