<?php

namespace Avertys\JsonApiResponse;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hoostr\JsonApiResponse\Skeleton\SkeletonClass
 */
class JsonApiResponseFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'json-api-response';
    }
}
