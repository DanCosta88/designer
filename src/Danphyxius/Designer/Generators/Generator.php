<?php namespace Danphyxius\Designer\Generators;

use Danphyxius\Designer\Compilers\Compiler;
use Danphyxius\Designer\Compilers\MustacheCompiler;
use Danphyxius\Designer\Console\GeneratorTrait;
use Danphyxius\Designer\Filesystem\Filesystem;

class Generator
{

    use GeneratorTrait;

    /**
     * The Filesystem instance.
     *
     * @var Filesystem
     */
    protected $file;

    /**
     * The Filesystem instance.
     *
     * @var Compiler
     */
    protected $compiler;

    /**
     * Create a new Generator instance.
     *
     * @param Filesystem $file
     * @param MustacheCompiler $compiler
     */
    public function __construct(Filesystem $file, MustacheCompiler $compiler)
    {
        $this->file = $file;
        $this->compiler = $compiler;
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
        if(! $template = json_decode($this->file->get($template)) ) {
            return false;
        }

        //todo: factorymethod for $this->template->create for each template, create new template class for each generate pattern
        return $this->createTemplate( $this->file, $template, $input );
    }


}
