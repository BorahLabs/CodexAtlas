<?php

namespace App\Actions;

trait AsAction
{
    public static function make(): static
    {
        return new static();
    }

    public static function dispatch(...$args)
    {
        return static::make()->handle(...$args);
    }
}
