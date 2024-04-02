<?php

if (! function_exists('y')) {
    function y() {
        return auth()->user()->id;
    }
}
