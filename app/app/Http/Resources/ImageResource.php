<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ImageResource extends JsonResource
{
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this['id'],
            'uploaded_at' => $this->uploaded_at,
            'source_filename' => $this->source_filename,
            'filename' => $this->filename,
            'thumb_url' => $this->getThumbUrl(),
            'image_url' => $this->getUrl(),
            'archive_url' => $this->getZipUrl(),
        ];
    }
}
