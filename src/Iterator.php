<?php namespace LC;

use DirectoryIterator;

class Iterator {

    protected $path;
    protected $directories;

    public function __construct($start_path)
    {
        $this->path = $start_path;

        $this->directories = new DirectoryIterator($start_path);
    }

    public function getFolders()
    {
        $folders = [];

        foreach($this->directories as $dir)
        {
            if($dir->isDir() && $dir->getFilename() != '.git' && !$dir->isDot())
            {
                $folders[] = $dir->getFilename();
            }
        }

        return $folders;
    }

    public function getFolderIterators(array $folders)
    {
        $iterators = [];

        foreach($folders as $folder)
        {
            $iterators[$folder] = new DirectoryIterator($this->path.'/'.$folder);
        }

        return $iterators;
    }

    public function getFolderClasses(DirectoryIterator $iterator)
    {
        $classes = [];

        foreach($iterator as $class)
        {
            if(!$class->isDot())
            {
                $classes[] = $class->getFilename();
            }
        }

        return $classes;
    }

}