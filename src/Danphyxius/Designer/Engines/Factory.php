<?php namespace Danphyxius\Designer\Engines;

abstract class Factory {

    /**
     * Create new engine
     *
     * @param array $options an options settings for engine implementation
     *
     * @return Engine a new engine
     */
    abstract public function createEngine($options);

}
