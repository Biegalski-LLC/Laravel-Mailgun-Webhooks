<?php

namespace Biegalski\LaravelMailgunWebhooks\Test\Feature;

use Orchestra\Testbench\TestCase;

class RouteTest extends TestCase
{
    /** @test */
    public function get_delivered_messages_route()
    {
        // Arrange

        // Act
        $response = $this->get('api/mailgun-webhooks/delivered-messages');

        // Assert
        $response->assertStatus(404);
    }
}
