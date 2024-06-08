<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class MainController
 */
class MainController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('main/index');
    }
}
