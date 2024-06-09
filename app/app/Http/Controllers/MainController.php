<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Utils\SortQuery;
use Illuminate\Http\Request;
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
        $sorts = SortQuery::parse($request->input('sort'));
        $query = Image::query();

        foreach ($sorts as $sortColumn => $sortDirection) {
            $query->orderBy($sortColumn, $sortDirection);
        }

        return view('main/index', [
            'images' => $query->paginate(10)
        ]);
    }
}
