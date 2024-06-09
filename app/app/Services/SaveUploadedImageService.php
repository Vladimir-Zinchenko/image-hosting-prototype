<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Rolandstarke\Thumbnail\Facades\Thumbnail;
use RuntimeException;

/**
 * Class SaveUploadedImageService
 */
readonly class SaveUploadedImageService
{
    /**
     * @param UploadedFile $image
     *
     * @return void
     */
    public function save(UploadedFile $image): void
    {
        $filename = $this->uniqueFilename($image->getClientOriginalName());
        $result = $image->storeAs(Image::UPLOAD_DIR, $filename, 'public');

        if ($result === false) {
            throw new RuntimeException('Failed to store image.');
        }

        Image::create([
            'filename' => $filename,
            'source_filename' => $image->getClientOriginalName()
        ]);
    }

    /**
     * @param string $sourceName
     *
     * @return string
     */
    private function uniqueFilename(string $sourceName): string
    {
        $sourceName = Str::transliterate($sourceName);
        $sourceName = Str::lower($sourceName);
        ['filename' => $filename, 'extension' => $extension] = pathinfo($sourceName);
        $filename = Str::slug($filename);
        $resultName = $filename . '.' . $extension;

        while (Storage::disk('public')->exists(Image::UPLOAD_DIR . '/' . $resultName)) {
            $suffix = Str::random(5);
            $suffix = Str::lower($suffix);
            $resultName = $filename . '-' .   $suffix . '.' . $extension;
        }

        return $resultName;
    }
}
