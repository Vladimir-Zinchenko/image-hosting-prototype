<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class UploadController
 */
class UploadController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('upload.index');
    }

    public function store(Request $request): Redirector
    {
//        dd($request->all());
        return redirect('/');
    }
}
