<?php
namespace Gallery;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * handles file upload
 */
class FileUploader implements ImagePathsInterface
{
    /** @var UploadedFile */
    protected $file;

    
    protected $folder;
    protected $filename;
    protected $mssg = '';

    function __construct($folder)
    {
        $this->folder = $folder;
    }

    public function uploadFiles(array $files) : array
    {
        $mssgs = [];
        foreach ($files as $file) {
            $this->setFile($file);
            $mssgs[] = $this->upload();
        }
        return $mssgs;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function setTargetFile()
    {
        $this->target_file = $this->folder  . '/' . $this->file->getClientOriginalName();
    }

    public function upload()
    {
        $this->setTargetFile();
        $tmpname = $this->file->getPathname();
        $filename = $this->file->getClientOriginalName();
        $destination = self::IMG_DIR . $this->target_file;
        
        $type = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

        $mssg =  'The file '. $filename . ' has been uploaded.';
        $destination = self::IMG_DIR . $this->target_file;
        // Check if file already exists
        if (file_exists($destination)) {
            $mssg = 'Sorry, file already exists.';
        } elseif (
            // $type == 'jpeg' ||
            $type == 'jpg' && 
            move_uploaded_file($tmpname, $destination) 
            ) {
                $this->create_thumb();
        } else {
            $mssg = 'Sorry, there was an error uploading your file. (Maybe you have to change .jepg to .jpg ?)';
        }
        return $mssg;
    }

    protected function create_thumb() {
        if (file_exists(self::IMG_DIR . $this->target_file)) {
           

            // check if folder exists
            if (!file_exists(self::THUMB_DIR . $this->folder)){
                mkdir(self::THUMB_DIR . $this->folder);
            }
            
            /* read the source image */
            $source_image = imagecreatefromjpeg(self::IMG_DIR . $this->target_file);
            
            $width = imagesx($source_image);
            $height = imagesy($source_image);
            
            $desired_width = 200;
            /* find the "desired height" of this thumbnail, relative to the desired width  */
            $desired_height = floor($height * ($desired_width / $width));

            /* create a new, "virtual" image */
            $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

            /* copy source image at a resized size */
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
            /* create the physical thumbnail image to its destination */
            imagejpeg($virtual_image, self::THUMB_DIR . $this->target_file);
        }
    }


}
