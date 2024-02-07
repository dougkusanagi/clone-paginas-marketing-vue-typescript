<?php

namespace App\Services;

use App\Models\ClonedPage;
use Illuminate\Support\Facades\Storage;
use Spatie\Crawler\Crawler;
use App\Services\DomCrawlerService;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class PageCrawlerService
{
    public function __construct(
        private Crawler $crawler
    ) {
    }

    public function start(string $url): void
    {
        $this->crawler->startCrawling($url);
    }

    public static function save(string $url, string $html)
    {
        $dom_crawler = new DomCrawlerService(new DomCrawler($html));
        $links = $dom_crawler->getLinks($html);
        $cloned_page = ClonedPage::create([
            'user_id' => auth()->user()->id,
            'url' => $url,
            'links' => json_encode($links),
        ]);

        self::storagePage($html, $cloned_page);
    }

    public static function storagePage(string $html, ClonedPage $cloned_page)
    {
        return Storage::disk('public')
            ->put("pages/$cloned_page->id/index.html", $html, 'public');
    }
}
