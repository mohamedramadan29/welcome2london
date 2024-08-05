<?php

namespace App\Http\Traits;
trait Upload_Images
{
    function saveImage($file, $path)
    {
        $file_extension = $file->getClientOriginalExtension();
        $file_name = time() . '_' . uniqid() . '.' . $file_extension;
        $file->move($path, $file_name);
        return $file_name;
    }
}
