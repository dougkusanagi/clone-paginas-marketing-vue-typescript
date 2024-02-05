<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class DomCrawlerService
{
    public function __construct(
        private Crawler $crawler
    ) {
    }

    public function getLinks(): array
    {
        $page_links = [];

        $this->crawler->filter('a')
            ->each(function ($node) use (&$page_links) {
                $page_links[] = $node->attr('href');
            });

        $links = array_map(fn ($link) => [
            $link => '',
        ], $page_links);

        return $links;
    }
}
