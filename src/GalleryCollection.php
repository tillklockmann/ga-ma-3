<?php

namespace Gallery;

class GalleryCollection 
{
    public function getFolderNames($path) 
    {
        return array_diff(scandir($path), ['..', '.']);
    }
}