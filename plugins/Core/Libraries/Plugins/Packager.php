<?php namespace Zix\Core\Libraries\Plugins;

use Illuminate\Filesystem\FilesystemManager;
use Zix\Core\Libraries\Plugins\Contracts\PackagerInterface;


/**
 * Class Packager
 * @package Zix\Core\Libraries\plugins\Helpers
 */
class Packager implements PackagerInterface
{
    /**
     * @var
     */
    protected $module;

    /**
     * @var
     */
    private $file;

    /**
     * Packager constructor.
     * @param FilesystemManager $file
     */
    public function __construct(FilesystemManager $file)
    {
        $this->file = $file;
    }


    /**
     * @param $module
     * @return $this
     */
    public function set($module)
    {
        $this->module = $module;
        return $this;
    }

    /**
     *
     */
    public function enable()
    {
        // TODO: Implement enable() method.
    }

    /**
     *
     */
    public function disable()
    {
        // TODO: Implement disable() method.
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function config()
    {
        return json_decode($this->file->get($this->module . '/config.json'));
    }

    /**
     * @return mixed
     */
    public function version()
    {
        return $this->config()->version;
    }


    /**
     * @return mixed
     */
    public function enabled()
    {
        return property_exists(\Plugins::plugins(), $this->name()) ? \Plugins::plugins()->{$this->name()}->status : false;
    }

    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->config()->providers;
    }

    /**
     * @return mixed
     */
    public function aliases()
    {
        return $this->config()->aliases;
    }

    /**
     * @return string
     */
    public function path()
    {
        return (string)$this->module;
    }

    /**
     * @return mixed
     */
    public function name()
    {
        return $this->config()->name;
    }


    /**
     * @param $extra
     * @return string
     */
    public function getExtraPath($extra)
    {
        return $this->path() . "/" . $extra;
    }
}