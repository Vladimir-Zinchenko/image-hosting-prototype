<?php

namespace App\Models;

use Akaunting\Sortable\Traits\Sortable;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rolandstarke\Thumbnail\Facades\Thumbnail;

/**
 * Class Image
 *
 * @property int $id
 * @property DateTime $uploaded_at
 * @property string $source_filename
 * @property string $filename
 */
class Image extends Model
{
    public const UPLOAD_DIR = 'images';

    public $timestamps = false;

    protected $fillable = ['source_filename', 'filename'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Image $model) {
            $model->uploaded_at = new DateTime();
        });

        static::addGlobalScope('order', function (Builder $query) {
            $query->orderBy('uploaded_at', 'desc');
        });
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'uploaded_at' => 'datetime',
        ];
    }

    /**
     * @param int $width
     * @param int $height
     *
     * @return string
     *
     * @throws Exception
     */
    public function getThumbUrl(int $width = 200, int $height = 200): string
    {
        return Thumbnail::src(self::UPLOAD_DIR . '/' . $this->filename, 'public')
            ->smartcrop($width, $height)
            ->url();
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return Storage::disk('public')->url(self::UPLOAD_DIR . '/' . $this->filename);
    }
}
