<?php namespace Danphyxius\Designer\Compilers;

interface Compiler {

    /**
     * Compile the template with
     * given data
     *
     * @param $template
     * @param $data
     */
    public function compile($template, $data);
}
