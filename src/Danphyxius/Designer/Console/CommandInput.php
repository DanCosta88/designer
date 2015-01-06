<?php namespace Danphyxius\Designer\Console;

class CommandInput {

    /**
     * @var string
     */
    public $pattern;
    /**
     * @var string
     */
    public $namespace;

    /**
     * @var string
     */
    public $tree;

    /**
     * @var array
     */
    public $properties = [];

    /**
     * @param $namespace
     * @param $properties
     */
    public function __construct($pattern, $namespace, $tree, $properties)
    {
        $this->pattern = $pattern;
        $this->namespace = $namespace;
        $this->tree = $this->parseTree($tree);
        $this->properties = $properties;
    }



    /**
     * @return string
     */
    public function parseTree($tree)
    {
        return implode('/', explode('\\', str_replace('/', '\\', $tree)));
    }

    /**
     * @return string
     */
    public function arguments()
    {
        return implode(', ', array_map(function($property)
        {
            return '$' . $property;
        }, $this->properties));
    }

}