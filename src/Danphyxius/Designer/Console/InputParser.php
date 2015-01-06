<?php namespace Danphyxius\Designer\Console;

class InputParser
{

    /**
     * Parse the command input.
     *
     * @param $path
     * @param $properties
     * @return CommandInput
     */
    public function parse($pattern, $path, $base, $properties)
    {
        $base = str_replace('//', '/', $base);
        $segments = explode('\\', str_replace('/', '\\', $path));
        $namespace = implode('\\', $segments);
        $pattern = strtolower($pattern);

        $base = implode('/', explode('\\', str_replace('/', '\\', $base)));
        $tree = implode('/', $segments);

        $properties = $this->parseProperties($properties);

        $tree = ( substr($base, -1) === '/' ) ? $base.$tree : $base . '/' . $tree;

        return new Input($pattern, $namespace, $tree, $properties);
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
