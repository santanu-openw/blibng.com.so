<?php namespace Zix\Core\Libraries\Plugins;

use Illuminate\Support\Facades\Facade;

/**
 * Class PluginsFacade
 * @package Zix\Core\Libraries\Plugins
 */
class PluginsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'plugins';
    }
}