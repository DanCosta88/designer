<?php namespace Danphyxius\Designer\Console;

class Input
{

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
     * @param $pattern
     * @param $namespace
     * @param $tree
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
     * @param $tree
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
