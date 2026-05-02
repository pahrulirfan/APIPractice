<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DocsController extends Controller
{
    /**
     * Display the API documentation page.
     */
    public function index(): View
    {
        return view('docs.index');
    }
}
