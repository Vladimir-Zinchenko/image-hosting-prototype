<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Services\ArchiveImageService;
use App\Utils\SortQuery;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class MainController
 */
class MainController extends Controller
{
    public function __construct(private readonly ArchiveImageService $archiveImage) {}

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

    /**
     * @param int $id
     *
     * @return BinaryFileResponse
     */
    public function download(int $id): BinaryFileResponse
    {
        $image = Image::query()->findOrFail($id);
        $archiveName = pathinfo($image->filename, PATHINFO_FILENAME) . '.zip';

        return response()->download($this->archiveImage->zip($image), $archiveName);
    }
}
