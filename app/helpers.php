<?php

if (! function_exists('newClass')) {
    function newClass($class) {
        return new $class;
    }
}