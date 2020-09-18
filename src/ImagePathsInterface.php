<?php

namespace Gallery;

interface ImagePathsInterface
{
    public const IMG_DIR = __DIR__ . '/../public/assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
    public const THUMB_DIR = __DIR__ . '/../public/assets' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
}