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

    /**
     * Display auth documentation.
     */
    public function auth(): View
    {
        return view('docs.index', ['section' => 'auth']);
    }

    /**
     * Display posts documentation.
     */
    public function posts(): View
    {
        return view('docs.index', ['section' => 'posts']);
    }

    /**
     * Display comments documentation.
     */
    public function comments(): View
    {
        return view('docs.index', ['section' => 'comments']);
    }

    /**
     * Display users documentation.
     */
    public function users(): View
    {
        return view('docs.index', ['section' => 'users']);
    }

    /**
     * Display pasien documentation.
     */
    public function pasien(): View
    {
        return view('docs.index', ['section' => 'pasien']);
    }

    /**
     * Display penyakit documentation.
     */
    public function penyakit(): View
    {
        return view('docs.index', ['section' => 'penyakit']);
    }

    /**
     * Display diagnosa documentation.
     */
    public function diagnosa(): View
    {
        return view('docs.index', ['section' => 'diagnosa']);
    }

    /**
     * Display vehicles documentation.
     */
    public function vehicles(): View
    {
        return view('docs.index', ['section' => 'vehicles']);
    }

    /**
     * Display medicines documentation.
     */
    public function medicines(): View
    {
        return view('docs.index', ['section' => 'medicines']);
    }
}
