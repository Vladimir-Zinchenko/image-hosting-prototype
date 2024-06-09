<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Class MainController
 */
class MainController extends Controller
{
    /**
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $sorts = explode(',', $request->input('sort', 'uploaded_at'));
        $query = Image::query();

        foreach ($sorts as $sortColumn) {
            $sortDirection = Str::startsWith($sortColumn, '-') ? 'desc' : 'asc';
            $sortColumn = ltrim($sortColumn, '-');

            $query->orderBy($sortColumn, $sortDirection);
        }

        return view('main/index', [
            'images' => $query->paginate(10)
        ]);
    }
}
