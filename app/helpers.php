<?php
if (!function_exists('app_url')) {
    function app_url($route)
    {
        return "http://romh.thedemo.co/#/" . $route;
    }
}