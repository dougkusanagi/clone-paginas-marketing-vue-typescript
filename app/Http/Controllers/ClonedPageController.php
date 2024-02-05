<?php

namespace App\Http\Controllers;

use App\Factories\PageCrawlerServiceFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClonedPageController extends Controller
{
    public function store(Request $request)
    {
        // $request->validate(['url' => 'required|url']);
        // dd($request->get('url'));

        PageCrawlerServiceFactory::create()
            ->start($request->get('url'));

        return to_route("dashboard")
            ->with("success", "Página clonada com sucesso!");
    }
}
