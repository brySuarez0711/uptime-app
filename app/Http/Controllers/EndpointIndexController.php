<?php

namespace App\Http\Controllers;

use App\Http\Resources\EndpointResource;
use App\Models\Endpoint;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EndpointIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request, Endpoint $endpoint)
    {

        // authorize

        // eager loading

        return Inertia::render('Endpoints/Index', [
            'endpoint' => EndpointResource::make($endpoint)
        ]);
    }
}