<?php

use Illuminate\Support\Facades\Storage;

function uploadFile($name, $dir, $request, $file)
{
    if ($request->hasFile($name)) {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $nameImg = uniqid() . '-' . $file->getClientOriginalName();
        $storage = Storage::disk('public');
        $storage->putFileAs($dir, $file, $nameImg);
        $pathName = $dir . $nameImg;

        return $pathName;
    }

    return '';
}
