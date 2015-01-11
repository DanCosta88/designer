<?php namespace Danphyxius\Designer\Filesystem;

use \Illuminate\Filesystem\Filesystem as IlluminateFilesystem;

class Filesystem {

    /**
     * Create a new Generator instance.
     *
     * @param IlluminateFilesystem $file
     */
    public function __construct(IlluminateFilesystem $file)
    {
        $this->file = $file;
    }

    /**
     * @param $path
     * @return string
     */
    public function get($path)
    {
        return $this->file->get($path);
    }

    /**
     * @param $path
     * @return string
     */
    public function put($path)
    {
        return $this->file->get($path);
    }

    /**
     * @param $file
     * @return bool
     * @throws FileNotFound
     */
    public function exists($file)
    {
        if ( ! $this->file->exists($file) )
        {
            throw new FileNotFound($file);
        }

        return $this->file->exists($file);
    }


}
