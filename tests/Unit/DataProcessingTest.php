<?php

namespace Hoostr\JsonApiResponse\Tests\Unit;

use Avertys\JsonApiResponse\JsonApiResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use ReflectionClass;
use Tests\TestCase;

class DataProcessingTest extends TestCase
{
    public function test_length_aware_paginator_processing(): void
    {
        $data = new LengthAwarePaginator([
            'item1', 'item2'
        ], 1,1);

        $reflection = new ReflectionClass(JsonApiResponse::class);
        $method = $reflection->getMethod('lengthAwarePaginatorProcessing');
        $method->setAccessible(true);

        $instance = new JsonApiResponse();
        
        $result = $method->invokeArgs($instance, [$data]);

       self::assertIsArray($result);
       self::assertArrayHasKey('data', $result);
       self::assertArrayHasKey('additional_data', $result);
       self::assertArrayHasKey('pagination', $result['additional_data']);
       self::assertCount(4, $result['additional_data']['pagination']);
    }

    public function test_default_data_processing(): void
    {
        $data = ['item1', 'item2'];

        $reflection = new ReflectionClass(JsonApiResponse::class);
        $method = $reflection->getMethod('defaultDataProcessing');
        $method->setAccessible(true);

        $instance = new JsonApiResponse();
        
        $result = $method->invokeArgs($instance, [$data]);
        self::assertIsArray($result);
        self::assertArrayHasKey('data', $result);
        self::assertEquals('item1', $result['data'][0]);
        self::assertEquals('item2', $result['data'][1]);
    }

}