<?php

use Illuminate\Support\Facades\Storage;

function storeDocument($file, $path = 'public/resumes') {
    $haystack = $file->store($path);
    $needle = "public/";
    $pos = strpos($haystack, "public/");
    if ($pos !== false) {
        return substr_replace($haystack, "storage/", $pos, strlen($needle));
    }
    return null;
}

function deleteDocument($haystack) {
    if ($haystack) {
        $needle = "storage/";
        $pos = strpos($haystack, "storage/");
        if ($pos !== false) {
            $path = substr_replace($haystack, "public/", $pos, strlen($needle));
            Storage::delete($path);
        }
    }
    return null;
}
