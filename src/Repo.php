<?php

namespace Gallery;

use Gallery\GalleryCollection;
use Gallery\ImagePathsInterface;

class Repo implements ImagePathsInterface 
{

    protected $images;

    public function __construct()
    {
        $this->images = new GalleryCollection;
    }
    
    public function getGalleryCount() : int
    {
        return count($this->images->getFolderNames(self::IMG_DIR));
    }

    public function getImageCount() 
    {
        return count($this->getAllImgs());
    }

    function getAllImgs() 
    {
        $path = self::IMG_DIR;
        $dirs = $this->images->getFolderNames($path);
       $all_imgs = [];



        foreach ($dirs as $gallery_name) {
            $dir2 = array_diff(scandir($path . $gallery_name), ['..', '.']);
            foreach ($dir2 as $src) {
                $all_imgs[] =  $gallery_name . '/' . $src;
            }
        }


        return $all_imgs;
    }

    public function getAllFolderNames() {
        return $this->images->getFolderNames(self::IMG_DIR);
    }

    public function getImgForFolder($dirs) {
        $path = self::IMG_DIR;
        $arr = [];
        foreach ($dirs as $gallery_name) {
            $imgs = array_diff(scandir($path . $gallery_name), ['..', '.']);
            $arr[$gallery_name] = $gallery_name . DIRECTORY_SEPARATOR . $imgs[3];
        }
        return $arr;
    }

    public function getGallery($name)
    {
        $path = self::IMG_DIR . $name ;
        
        $arr = array_diff(scandir($path), ['..', '.']);
        $img_filepath = array_map(function($filename) use ($name){
            return $name . DIRECTORY_SEPARATOR . $filename;
        }, $arr);
        return $img_filepath;
    }

}
