<?php namespace Danphyxius\Designer\Compilers;

use Danphyxius\Designer\Engines\Engine;
use Danphyxius\Designer\Engines\MustacheFactory;
use Mustache_Engine;

class MustacheCompiler extends TemplateCompiler implements Compiler {

    /**
     * Create a new Mustache Compiler instance.
     * @param MustacheFactory $factory
     * @param array $options
     */
    function __construct(MustacheFactory $factory, $options = array())
    {
        parent::__construct($factory, $options);
    }

    /**
     * Compile the template with
     * given data
     *
     * @param $template
     * @param $data
     * @return mixed
     */
    public function compile($template, $data)
    {
        return $this->engine->render($template, $data);
    }
}
