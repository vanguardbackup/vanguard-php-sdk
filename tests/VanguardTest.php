<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use VanguardBackup\Vanguard\Exceptions\NotFoundException;
use VanguardBackup\Vanguard\Exceptions\ValidationException;
use VanguardBackup\Vanguard\Exceptions\RateLimitExceededException;
use VanguardBackup\Vanguard\VanguardClient;
use Mockery;
use PHPUnit\Framework\TestCase;

class VanguardTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function test_making_basic_requests(): void
    {
        $vanguard = new VanguardClient('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
            new Response(200, [], '{"data": [{"id": 1, "label": "Test Tag"}]}')
        );

        $this->assertCount(1, $vanguard->tags());
    }

    public function test_update_backup_task(): void
    {
        $vanguard = new VanguardClient('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('PUT', 'backup-tasks/456', [
            'json' => ['label' => 'Updated Backup Task'],
        ])->andReturn(
            new Response(200, [], '{"data": {"id": 456, "label": "Updated Backup Task"}}')
        );

        $this->assertSame('Updated Backup Task', $vanguard->updateBackupTask('456', [
            'label' => 'Updated Backup Task',
        ])->label);
    }

    public function test_handling_validation_errors(): void
    {
        $vanguard = new VanguardClient('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
            new Response(422, [], '{"error": "Validation Error", "message": "The given data was invalid.", "errors": {"label": ["The label field is required."]}}')
        );

        try {
            $vanguard->tags();
        } catch (ValidationException $e) {
            $this->assertEquals(['label' => ['The label field is required.']], $e->getErrors());
        }
    }

    public function test_handling_404_errors(): void
    {
        $this->expectException(NotFoundException::class);

        $vanguard = new VanguardClient('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
            new Response(404)
        );

        $vanguard->tags();
    }

    public function testRateLimitExceededWithHeaderSet(): void
    {
        $vanguard = new VanguardClient('123', $http = Mockery::mock(Client::class));

        $timestamp = strtotime(date('Y-m-d H:i:s'));

        $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
            new Response(429, [
                'x-ratelimit-reset' => $timestamp,
            ], 'Too Many Attempts.')
        );

        try {
            $vanguard->tags();
        } catch (RateLimitExceededException $e) {
            $this->assertSame($timestamp, $e->getRateLimitResetsAt());
        }
    }

    public function testRateLimitExceededWithHeaderNotAvailable(): void
    {
        $vanguard = new VanguardClient('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
            new Response(429, [], 'Too Many Attempts.')
        );

        try {
            $vanguard->tags();
        } catch (RateLimitExceededException $e) {
            $this->assertNull($e->getRateLimitResetsAt());
        }
    }

    public function test_run_backup_task(): void
    {
        $vanguard = new VanguardClient('123', $http = Mockery::mock(Client::class));

        $http->shouldReceive('request')->once()->with('POST', 'backup-tasks/789/run', [])->andReturn(
            new Response(200, [], '{"message": "Backup task initiated successfully."}')
        );

        $response = $vanguard->runBackupTask('789');
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('Backup task initiated successfully.', $response['message']);
    }
}