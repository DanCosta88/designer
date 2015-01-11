<?php namespace Danphyxius\Designer\Engines;

use Mustache_Engine;

class MustacheFactory extends Factory{

    /**
     * Create new engine
     *
     * @param array $options
     * @return Engine a new engine
     */
    public function createEngine($options = array())
    {
        return new Mustache\Engine(new Mustache_Engine($options));
    }

}
