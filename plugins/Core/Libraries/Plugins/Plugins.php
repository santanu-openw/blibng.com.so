<?php namespace Zix\Core\Libraries\Plugins;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;

/**
 * Class Plugins
 * @package Zix\Core\Libraries\Plugins
 */
class Plugins
{
    /**
     * @var Filesystem
     */
    private $file;
    /**
     * @var Packager
     */
    private $packager;

    /**
     * Repository constructor.
     * @param FilesystemManager $file
     * @internal param null $path
     */
    public function __construct(FilesystemManager $file)
    {
        $this->file = $file;
    }


    /**
     * Get Module Package By Name.
     * @param $module
     * @return array
     */
    public function get($module)
    {
        return $this->all()->get($module);
    }

    /**
     * Get All plugins.
     * @return array
     */
    public function all()
    {
        $plugins = [];

        foreach ($this->scan() as $key => $module) {
            $package = new Packager($this->file);
            $plugins[$package->set($module)->name()] = $package->set($module);
        }

        return collect(array_sort($plugins, function ($plugin) {
            return $plugin->config()->order;
        }));
    }

    /**
     * @return mixed
     */
    public function enabledPlugins()
    {
        return $this->all()->filter(function ($plugin) {
            return ($plugin->enabled() || $plugin->name() == 'Core');
        });
    }

    /**
     * Get All plugins.
     * @return array
     */
    public function scan()
    {
        return $this->file->directories('plugins');
    }

    /**
     * @return mixed
     */
    public function plugins()
    {
        $file = $this->file->get('plugins/plugins.json');
        return json_decode($file);
    }

    /**
     * @return bool
     */
    public function install()
    {
        // 1. check if plugins [] is empty and there no db installed => ? true : false
        if (!property_exists($this->plugins(), 'Core')) {

            $this->file->put('plugins/plugins.json', json_encode($this->all()->map(function ($plugin) {
                return [
                    "name" => $plugin->config()->name,
                    "version" => $plugin->config()->version,
                    "status" => true
                ];
            })));
        }
        return false;
    }

    /**
     * TMP
     */
    public function update()
    {
        $this->file->put('plugins/plugins.json', json_encode($this->all()->map(function ($plugin) {
            return [
                "name" => $plugin->config()->name,
                "version" => $plugin->config()->version,
                "status" => true
            ];
        })));
    }
}