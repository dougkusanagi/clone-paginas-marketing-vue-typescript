<?php

namespace App\Http\Controllers;

use App\Factories\PageCrawlerServiceFactory;
use App\Models\ClonedPage;
use Illuminate\Http\Request;
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
            return inertia("Dashboard")
                ->with("warning", "Algum erro aconteceu ao tentar clonar a página {$url}. Tente novamente mais tarde.");
        }

        return inertia("Dashboard", [
            "id" => $latest_page->id,
            "url" => $latest_page->url,
        ])
            ->with("success", "Página clonada com sucesso!");
    }
}
