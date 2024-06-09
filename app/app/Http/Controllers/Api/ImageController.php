<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ImageResourceCollection;
use App\Models\Image;
use App\Utils\SortQuery;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * @param Request $request
     *
     * @return ImageResourceCollection
     */
    public function index(Request $request): ImageResourceCollection
    {
        $sorts = SortQuery::parse($request->input('sort'));
        $query = Image::query();

        foreach ($sorts as $sortColumn => $sortDirection) {
            $query->orderBy($sortColumn, $sortDirection);
        }

        return new ImageResourceCollection($query->paginate(10));
    }

    /**
     * @param int $id
     *
     * @return ImageResource
     */
    public function view(int $id): ImageResource
    {
        $image = Image::query()->findOrFail($id);

        return new ImageResource($image);
    }
}
