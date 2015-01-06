<?php namespace Danphyxius\Designer\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Mustache_Engine;

class PatternGenerator
{

    use GeneratorTrait;

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
     * Create a new PatternGenerator instance.
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
     * Generate the structure for a design pattern.
     *
     * @param Input $input
     * @param $template
     * @return bool
     */
    public function make(Input $input, $template)
    {
        $template = json_decode($this->file->get($template));

        if( $template ) {

            if (! $this->file->isDirectory($input->tree) ) {
                $this->createFolder($this->file, $input->tree);
            }

            $this->createTemplate($this->file, $template, $input);

            return true;
        }
    }

}
