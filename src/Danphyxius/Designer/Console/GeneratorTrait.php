<?php namespace Danphyxius\Designer\Console;

use Illuminate\Filesystem\Filesystem;

trait GeneratorTrait
{

    /**
     * @param Filesystem $filesystem
     * @param $file
     * @param $input
     */
    public function createFile(Filesystem $filesystem, $file, $input)
    {

        $template = $filesystem->get(__DIR__.'/../patterns/'.$input->pattern.'/'.$file->file);
        $input->name = str_replace('.php.stub', '', $file->file);

        $stub = $this->mustache->render($template, $input);
        $filesystem->put($input->tree.'/'.str_replace('.stub', '', $file->file), $stub);
    }


    /**
     * @param Filesystem $fileSystem
     * @param $path
     */
    public function createFolder(Filesystem $fileSystem, $path)
    {
        $fileSystem->makeDirectory($path, $mode = 777, true, true);
    }


    /**
     * @param Filesystem $filesystem
     * @param $file
     * @param $input
     */
    public function createInDirectory(Filesystem $filesystem, $file, $input)
    {
        if(! $filesystem->exists($input->tree.'/'.$file->path) ) {
            $this->createFolder($this->file, $input->tree.'/'.$file->path);
        }

        $input->name = str_replace('.php.stub', '', $file->file);
        $input->path = str_replace('/', '\\', $file->path);

        $template = $filesystem->get(__DIR__.'/../patterns/'.$input->pattern.'/'.$file->file);
        $stub = $this->mustache->render($template, $input);
        $filesystem->put($input->tree.'/'.$file->path.'/'.str_replace('.stub', '', $file->file), $stub);
    }


    /**
     * @param Filesystem $fileSystem
     * @param $source
     * @param $destination
     */
    public function copyUml(Filesystem $fileSystem, $source, $destination)
    {
        $fileSystem->copyDirectory($source, $destination);
    }


    /**
     * @param $template
     * @param $input
     */
    public function createTemplate(Filesystem $filesystem, $template, $input)
    {

        if (! $filesystem->isDirectory($input->tree) ) {
            $this->createFolder($filesystem, $input->tree);
        }

        if (isset($template->folders)) {
            foreach($template->folders as $folder) {
                $this->createFolder($filesystem, $input->tree.'/'.$folder);
            }
        }

        if (isset($template->files)) {
            foreach($template->files as $file) {
                if ($file->path == false) {
                    $this->createFile($filesystem, $file, $input);
                } else {
                    $this->createInDirectory($filesystem, $file, $input);
                }
            }
        }

        if ($template->uml) {
            $this->copyUml($filesystem, __DIR__.'/../patterns/'.$input->pattern.'/uml', $input->tree);
        }
    }


}
