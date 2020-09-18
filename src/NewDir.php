<?php

namespace Gallery;
use Symfony\Component\HttpFoundation\InputBag;

class NewDir  implements ImagePathsInterface
{
    /** @var InputBag */
    protected $post;
    
    public function __construct($post)
    {
         $this->post = $post;
    }

    public function mkdir()
    {
        $msg = 'getting started';
        
        $dirname = $this->post->get('new-folder-name');
        if(isset($dirname) && !empty(trim($dirname))) {
            
            if (!file_exists(self::IMG_DIR . $dirname)){
              mkdir(self::IMG_DIR . $dirname);
              $msg = "Direcotry $dirname was succesfully created";
            } else {
              $msg = "Directory $dirname already exists!";
            }
          
          } else {
            $msg = "couldn't create directory";
          }
          return $msg;
    }
}