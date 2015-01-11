<?php namespace Danphyxius\Designer\Compilers;

use Danphyxius\Designer\Engines\Factory;

abstract class TemplateCompiler {

    /**
     * Engine to compile template
     */
    protected $engine;

    /**
     * Create a new Compiler instance.
     * @param Factory $engineFactory
     * @param array $options
     */
    public function __construct(Factory $engineFactory, $options = array())
    {
        $this->engine = $engineFactory->createEngine($options);
    }

    /**
     * Compile the template with
     * given data
     *
     * @param $template
     * @param $data
     */
    abstract public function compile($template, $data);

}
