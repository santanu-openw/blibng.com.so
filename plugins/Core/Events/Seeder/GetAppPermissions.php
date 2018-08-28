<?php

namespace Zix\Core\Events\Seeder;

use Illuminate\Support\Collection;

/**
 * Class GetAppPermissions
 * @package Zix\Core\Events\Seeder
 */
class GetAppPermissions
{
    /**
     * @var Collection
     */
    public $collection;


    /**
     * AppPermissionsCreate constructor.
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

}
