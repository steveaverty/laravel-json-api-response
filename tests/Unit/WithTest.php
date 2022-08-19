<?php

namespace Tests\Unit;

use Avertys\JsonApiResponse\JsonApiResponse;
use Tests\TestCase;

class WithTest extends TestCase
{
    public function test_with_success(): void
    {
        $instance = new JsonApiResponse();
        $result = $instance->withSuccess();

        self::assertInstanceOf(JsonApiResponse::class, $result);
        self::assertTrue($result->response['success']);
    }

    public function test_with_errors(): void
    {
        $instance = new JsonApiResponse();
        $result = $instance->withErrors(['err1', 'err2']);

        self::assertInstanceOf(JsonApiResponse::class, $result);
        self::assertFalse($result->response['success']);
        self::assertEquals('err1', $result->response['errors'][0]);
        self::assertEquals('err2', $result->response['errors'][1]);
    }

    public function test_with_additional_data(): void
    {
        $instance = new JsonApiResponse();
        $result = $instance->withAdditionalData([
            'deprecated' => true
        ]);

        self::assertInstanceOf(JsonApiResponse::class, $result);
        self::assertTrue($result->response['additional_data']['deprecated']);
    }

}