<?php

namespace App\Http\Controllers;

use App\Factories\PageCrawlerServiceFactory;
use App\Models\ClonedPage;
use App\Services\DomCrawlerService;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;
use Illuminate\Support\Facades\Session;

class ClonedPageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['url' => 'required|url']);
        $url = $request->get('url');
        $last_page = ClonedPage::latest()->first();

        PageCrawlerServiceFactory::create()
            ->start($url);

        $latest_page = ClonedPage::latest()->first();

        if ($last_page && $latest_page->id == $last_page->id) {
            return response(500)->json([
                "error" => "Algum erro aconteceu ao tentar clonar a página {$url}. Tente novamente mais tarde.",
            ]);
        }

        return response()->json([
            "id" => $latest_page->id,
            "url" => $latest_page->url,
            "success" => "Página clonada com sucesso!",
        ]);
    }

    public function edit(ClonedPage $clonedPage)
    {
        return view('cloned-page.edit', [
            'clonedPage' => $clonedPage
        ]);
    }

    public function updateHtml(Request $request)
    {
        $data = json_decode($request->get('data'), true);
        $dom_crawler = new DomCrawlerService(new DomCrawler($data['content']));
        $cloned_page = ClonedPage::find($data['id']);
        $page = $dom_crawler->newPage($cloned_page);

        dd($data['id'], $data['content']);

        return response()->json($html);
    }
}
