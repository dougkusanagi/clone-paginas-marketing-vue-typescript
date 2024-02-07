<?php

namespace App\Services;

use App\Models\ClonedPage;
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

    public function newPage(ClonedPage $cloned_page)
    {
        $head = $this->crawler->filter("#shadow_root_head")->html();
        $body = $this->id("#shadow_root_body");
        $bodyClass = $this->id("#shadow_root_bodyClass");
        $page = <<<HTML
        <html>
            <head>
                {$head}
            </head>
            <body class="{$bodyClass}">
                {$body}
            </body>
        </html>
        HTML;

        PageCrawlerService::storagePage($page, $cloned_page);
    }

    public function id(string $id)
    {
        return $this->crawler->filter($id)->html();
    }
}
