<?php

namespace Avertys\JsonApiResponse;

trait DataProcessing
{
    /**
     * Format response when the data come from pagination eloquent method. 
     *
     * @param   mixed  $data 
     *
     * @return  array 
     */
    protected function lengthAwarePaginatorProcessing(mixed $data): array
    {
        return [
            'data' => $data->toArray()['data'],
            'additional_data' => [
                'pagination' => [
                    'current_page' => $data->toArray()['current_page'],
                    'per_page' => $data->toArray()['per_page'],
                    'to' => $data->toArray()['to'],
                    'total' => $data->toArray()['total'],
                ]
            ]
        ];
    }

    /**
     * Format response when the data is a collection,a  model or an array. 
     *
     * @param   mixed  $data
     *
     * @return  array 
     */
    protected function defaultDataProcessing(mixed $data): array
    {
        return [
            'data' => $data
        ];
    }
}