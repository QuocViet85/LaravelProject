<?php

use Illuminate\Support\Facades\File;

function deleteFileStorage($image) {
    $imagePath = public_path(str_replace('/', '\\', $image));
    File::delete($imagePath);
}