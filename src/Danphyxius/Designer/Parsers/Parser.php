<?php namespace Danphyxius\Designer\Parsers;


interface Parser {

    /**
     * Parse the command input.
     * @param array $args
     * @return mixed
     */
    public function parse($args = array());

}
