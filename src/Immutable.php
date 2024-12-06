<?php

namespace SteefMin\Immutable;

trait Immutable
{
    /**
     * Implements all with<PropertyName> methods on the class that uses this trait
     * @return static
     */
    public function __call(string $name, $args)
    {
        $name = str_replace('with', '', $name);
        $name = lcfirst($name);

        $props = get_object_vars($this);
        $propNames = array_keys($props);
        assert(count(array_filter($propNames, fn (string $propName) => $propName === $name)) === 1, 'No property named `' . $name . '`');

        assert(count($args) === 1, 'Can only update one argument at a time');
        $props[$name] = array_shift($args);
        return new self(...array_values($props));
    }
}
