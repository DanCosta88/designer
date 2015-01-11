<?php namespace Danphyxius\Designer\Engines\Mustache;

use \Danphyxius\Designer\Engines\Engine as BaseEngine;
use Mustache_Engine;

class Engine implements BaseEngine {

    /**
     * @var Mustache_Engine
     */
    protected $engine;

    /**
     * @param Mustache_Engine $engine
     */
    function __construct(Mustache_Engine $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Compile the template with
     * given data
     *
     * @param $template
     * @param $data
     * @return mixed
     */
    public function render($template, $data)
    {
        return $this->engine->render($template, $data);
    }
}
