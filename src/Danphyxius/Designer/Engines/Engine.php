<?php namespace Danphyxius\Designer\Engines;

interface Engine {

    /**
     * Compile the template with
     * given data
     *
     * @param $template
     * @param $data
     * @return mixed
     */
    public function render($template, $data);

}
