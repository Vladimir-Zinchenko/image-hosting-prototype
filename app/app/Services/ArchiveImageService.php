<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

/**
 * Class ArchiveImageService
 */
class ArchiveImageService
{
    /**
     * @param Image $image
     *
     * @return string
     */
    public function zip(Image $image): string
    {
        $archiveName = tempnam(sys_get_temp_dir(), 'images');
        $zip = new ZipArchive();
        $imageFile = Storage::disk('public')->path(Image::UPLOAD_DIR . '/'. $image->filename);

        $zip->open($archiveName, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFile($imageFile, $image->source_filename);
        $zip->close();

        return $archiveName;
    }
}
