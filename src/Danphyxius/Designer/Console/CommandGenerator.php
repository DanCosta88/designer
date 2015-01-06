<?php namespace Danphyxius\Designer\Console;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

class CommandGenerator {

    /**
     * The Filesystem instance.
     *
     * @var Filesystem
     */
    protected $file;

    /**
     * The Mustache_Engine instance.
     *
     * @var Mustache_Engine
     */
    protected $mustache;

    /**
     * Creat a new CommandGenerator instance.
     *
     * @param Filesystem $file
     * @param Mustache_Engine $mustache
     */
    public function __construct(Filesystem $file, Mustache_Engine $mustache)
    {
        $this->file = $file;
        $this->mustache = $mustache;
    }

    /**
     * Generate the files for a new design pattern.
     * 
     * @param CommandInput $input
     * @param $template
     */
    public function make(CommandInput $input, $template)
    {
        $template = json_decode($this->file->get($template));

        if( $template ) {

            if (! $this->file->isDirectory($input->tree) ) {
                $this->createFolder($input->tree);
            }

            $this->createTemplate($template, $input);
        }
    }

    /**
     * @param $template
     * @param $input
     */
    public function createTemplate($template, $input) {

        if (isset($template->folders)) {
            foreach($template->folders as $folder) {
                $this->createFolder($input->tree.'/'.$folder);
            }
        }

        if (isset($template->files)) {
            foreach($template->files as $file) {
                $this->createFile($file, $input);
            }
        }

    }


    /**
     * @param $path
     */
    public function createFolder($path) {
        $this->file->makeDirectory($path, $mode = 777, true, true);
    }


    /**
     * @param $file
     * @param $input
     */
    public function createFile($file, $input) {

        $template = $this->file->get(__DIR__.'/../patterns/'.$input->pattern.'/'.$file->file);
        $stub = $this->mustache->render($template, $input);

        $this->file->put($input->tree.'/'.str_replace('.stub', '', $file->file), $stub);
    }

}
