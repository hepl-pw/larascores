<?php

namespace App\Uploads;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait Logos
{
    public function handleUploads(FormRequest $request)
    {
        $newFileName = $request->file('logo')->hashName();
        $targetDirectory = 'app/public/teams-logos/s45/';
        $newFilePath = $targetDirectory.$newFileName;
        Storage::makeDirectory('teams-logos/s45');
        //Change Image Size
        $image = $request->file('logo');
        $image_resized = Image::make($image->getRealPath());
        $image_resized->resize(45, 45);
        $image_resized->save(storage_path($newFilePath));

        return $newFileName;
    }
}
