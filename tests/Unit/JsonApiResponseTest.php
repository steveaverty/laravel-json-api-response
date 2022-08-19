<?php

namespace Avertys\JsonApiResponse\Tests\Unit;

use App\Http\Resources\UserResource;
use App\Models\User;
use Avertys\JsonApiResponse\JsonApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use ReflectionClass;
use Tests\TestCase;

class JsonApiResponseTest extends TestCase
{
    public function test_build_with_array(): void
    {
        $data = [
            'item1', 'item2'
        ];

        $reflection = new ReflectionClass(JsonApiResponse::class);
        $method = $reflection->getMethod('build');
        $method->setAccessible(true);

        $instance = new JsonApiResponse();
        
        $result = $method->invokeArgs($instance, [$data]);

        self::assertIsArray($result);
        self::assertEquals('item1', $result['data'][0]);
        self::assertEquals('item2', $result['data'][1]);
    }

    public function test_build_with_resource(): void
    {
        $data = UserResource::make(new User());
        $reflection = new ReflectionClass(JsonApiResponse::class);
        $method = $reflection->getMethod('build');
        $method->setAccessible(true);

        $instance = new JsonApiResponse();
        
        $result = $method->invokeArgs($instance, [$data]);

        self::assertIsArray($result);
    }

    public function test_build_with_collection(): void
    {
        $data = UserResource::collection([new User()]);
        $reflection = new ReflectionClass(JsonApiResponse::class);
        $method = $reflection->getMethod('build');
        $method->setAccessible(true);

        $instance = new JsonApiResponse();
        
        $result = $method->invokeArgs($instance, [$data]);

        self::assertIsArray($result);
    }

    public function test_build_with_resource_and_pagination(): void
    {
        $data = UserResource::make(
            new LengthAwarePaginator([
                'item1', 'item2'
            ], 1,1)
        );
        $reflection = new ReflectionClass(JsonApiResponse::class);
        $method = $reflection->getMethod('build');
        $method->setAccessible(true);

        $instance = new JsonApiResponse();
        
        $result = $method->invokeArgs($instance, [$data]);

        self::assertIsArray($result);
        self::assertEquals('item1', $result['data'][0]);
        self::assertEquals('item2', $result['data'][1]);
    }

    public function test_make(): void
    {
        self::assertInstanceOf(JsonApiResponse::class, JsonApiResponse::make([]));
    }

    public function test_send(): void
    {
        $instance = new JsonApiResponse([]);
        $result = $instance->send(201);
        $data  = json_decode($result->content());

        self::assertInstanceOf(JsonResponse::class, $result);
        self::assertIsBool($data->success);
        self::assertIsArray($data->data);
        self::assertNull($data->errors);
        self::assertNull($data->additional_data);
    }
}