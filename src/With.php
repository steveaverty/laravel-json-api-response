<?php

namespace Avertys\JsonApiResponse;

trait With
{
    /**
     * With success
     *
     * @return  JsonApiResponse
     */
    public function withSuccess():  JsonApiResponse
    {
        $this->response['success'] = true;
        return $this;
    }

    /**
     * With errors
     *
     * @param   mixed  $errors
     *
     * @return  JsonApiResponse
     */
    public function withErrors(mixed $errors):  JsonApiResponse
    {
        $this->response['success'] = false;
        $this->response['errors'] = $errors ?? [];

        return $this;
    }

    /**
     * Add additional data to the response
     *
     * @param   mixed   $additionalData 
     *
     * @return  JsonApiResponse
     */
    public function withAdditionalData(mixed $additionalData): JsonApiResponse
    {
        $this->response['additional_data'] = [...$this->response['additional_data'] ?? [], ...$additionalData];

        return $this;
    }
}