<?php

namespace Avertys\JsonApiResponse;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class JsonApiResponse
{
    use With, DataProcessing;

    /**
     * Response
     *
     * @var array
     */
    public $response = [];

    /**
     * Constructor
     *
     * @param   mixed  $data  Collection, model, array or paginator
     *
     * @return void
     */
    public function __construct(mixed $data = null)
    {
        $this->response = $data === null ? [] : $this->build($data);
    }

    /**
     * Add default data, matching with the type of injected data.
     *
     * @param   mixed  $data  Collection, model or paginator instance. 
     *
     * @return  array 
     */
    protected function build(mixed $data): array
    {
        if(gettype($data) === 'object'){
            $item =  isset($data->resource) ? $data->resource : $data;

            switch(get_class($item)){
                case LengthAwarePaginator::class:
                    return $this->lengthAwarePaginatorProcessing($item);
                default:
                    break;
            }
        }

        return $this->defaultDataProcessing($data);
    }

    /**
     * Instantiate instance from static method. Used to chain method. 
     *
     * @param   mixed  $data
     *
     * @return  JsonApiResponse 
     */
    public static function make(mixed $data = null): JsonApiResponse
    {
        return new self($data);
    }

    /**
     * Send data as JsonResponse
     *
     * @param   int  $status Status of the responses, 200 by default. 
     *
     * @return  JsonResponse
     */
    public function send($status= 200): JsonResponse
    {
        return response()->json([
            'success' => $this->response['success'] ?? true,
            'data' => $this->response['data'] ?? null,
            'errors' => $this->response['errors'] ?? null,
            'additional_data' => $this->response['additional_data'] ?? null,
        ], $status);
    }
}