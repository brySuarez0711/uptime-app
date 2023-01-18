<?php

namespace App\Http\Controllers;

use App\Http\Resources\EndpointResource;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    protected $endpoints;

    public function __construct()
    {
        //
    }
    public function __invoke(Request $request, Site $site)
    {

        $site->update(['default' => true]);

        if (!$site->exist) {
            // we have not actually chosen a site
            $site = $request->user()->sites()->whereDefault(true)->first() ?? $request->user()->sites()->first();
        }



        return Inertia::render('Dashboard', [
            'site' => SiteResource::make($site),
            'sites' => SiteResource::collection(Site::get()),
            'endpoints' => EndpointResource::collection($site->endpoints)
        ]);
    }
}