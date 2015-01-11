<?php namespace Danphyxius\Designer\Parsers;

class InputParser implements Parser
{
    /**
     * Parse the command input.
     *
     * @param $args
     * @return CommandInput
     */
    public function parse($args = array())
    {
        return new Input($this->parseInput($args));
    }

    /**
     * @param $args
     * @return array
     */
    public function parseInput($args)
    {
        $base = str_replace('//', '/', $args['base']);
        $base = implode('/', explode('\\', str_replace('/', '\\', $base)));

        $segments = explode('\\', str_replace('/', '\\', $args['path']));
        $namespace = implode('\\', $segments);

        $pattern = strtolower($args['pattern']);

        $tree = implode('/', $segments);
        $tree = ( substr($base, -1) === '/' ) ? $base.$tree : $base . '/' . $tree;

        $properties = $this->parseProperties($args['properties']);

        return array($pattern, $namespace, $tree, $properties);
    }

    /**
     * Parse the properties for a command.
     *
     * @param $properties
     * @return array
     */
    private function parseProperties($properties)
    {
        return preg_split('/ ?, ?/', $properties, null, PREG_SPLIT_NO_EMPTY);
    }

}
