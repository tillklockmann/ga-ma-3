<?php
namespace Gallery;
use Gallery\View;
use Gallery\Repo;
use Gallery\FileUploader;
use Symfony\Component\HttpFoundation\Request;

class Controller 
{
    /** @var Repo */
    protected $galleryRepo;

    /**
     * @var View
     */
    protected $view;

    public function __construct(Repo $galleryRepo, View $view)
    {
        $this->galleryRepo = $galleryRepo;
        $this->view = $view;
    }

    public function upload(Request $request, array $var)
    {
       
        $folder = urldecode(($var['name']));
        $imgs = $request->files->all()['upload'];
        $uploader = new FileUploader($folder);
        $mssg = $uploader->uploadFiles($imgs);
        var_dump($mssg);
    }


    public function all($request)
    {
        $all_imgs = $this->galleryRepo->getAllImgs();
        $names = $this->galleryRepo->getAllFolderNames();

        $this->view
            ->template('all_imgs')
            ->set('all_imgs', $all_imgs)
            ->set('all_galleries', $names)
            ->render();
    }

    
    public function home($request) 
    {
        $names = $this->galleryRepo->getAllFolderNames();
        $galleries = $this->galleryRepo->getImgForFolder($names);
        $countGalleries = $this->galleryRepo->getGalleryCount();
        $countImgs = $this->galleryRepo->getImageCount();
        $info = $countGalleries . ' Galleries  | ' . $countImgs . ' images';
        $this->view
            ->template('overview')
            ->set('galleries', $galleries)
            ->set('info', $info)
            ->set('add_what', 'folder')
            ->render();
    }

    public function gallery($request, $vars) 
    {
        $name = urldecode($vars['name']);
        $imgs = $this->galleryRepo->getGallery($name);

        $this->view
            ->template('gallery')
            ->set('imgs', $imgs)
            ->set('name', $name)
            ->set('info', $name)
            ->set('add_what', 'images')
            ->render();
    }

    public function newFolder(Request $request)
    {
        $dir = new NewDir($request->request);
        $responseText = $dir->mkdir();
        var_dump($responseText);
    }
}