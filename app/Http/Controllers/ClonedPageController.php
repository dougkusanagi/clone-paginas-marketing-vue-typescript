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
        // $request->validate(['url' => 'required|url']);
        // dd($request->get('url'));

        $last_page = ClonedPage::latest()->first();

        PageCrawlerServiceFactory::create()
            ->start($request->get('url'));

        $latest_page = ClonedPage::latest()->first();

        if ($last_page && $latest_page->id == $last_page->id) {
            return to_route("dashboard")
                ->with("warning", "Algum erro aconteceu. Tente novamente mais tarde.");
        }

        return to_route("dashboard", [
            "id" => $latest_page->id
        ])->with("success", "Página clonada com sucesso!");
    }
}
