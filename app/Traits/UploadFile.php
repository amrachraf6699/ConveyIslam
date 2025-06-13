<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Str;

trait UploadFile
{
    /**
     * Store a file in the public storage and link it to the public folder.
     *
     * @param string $path
     * @return string|null The public URL of the stored file or null on failure
     */
    public function UploadFile($file, string $path): ?string
    {
        $file_name = Str::uuid() . '.' . $file->getClientOriginalExtension();

        if (Storage::disk('public')->putFileAs($path, $file, $file_name)) {
            return $path . '/' . $file_name;
        }
    }
}