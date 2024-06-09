<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadValidationRequest;
use App\Services\SaveUploadedImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class UploadController
 */
class UploadController extends Controller
{
    public function __construct(private readonly SaveUploadedImageService $uploadedImageService) {}

    /**
     * @return View
     */
    public function index(): View
    {
        return view('upload.index');
    }

    /**
     * @param UploadValidationRequest $request
     *
     * @return JsonResponse
     */
    public function store(UploadValidationRequest $request): JsonResponse
    {
        $images = $request->file('file');

        foreach ($images as $image) {
            $this->uploadedImageService->save($image);
        }

        return response()->json(['OK']);
    }
}
