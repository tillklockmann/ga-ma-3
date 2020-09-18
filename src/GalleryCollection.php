<?php

namespace Gallery;

class GalleryCollection 
{
    public function getFolderNames($path) 
    {   
        if (is_readable($path)) {
            return array_diff(scandir($path), ['..', '.', '.gitignore']);
        } else {
            return [];
        }
    }
}