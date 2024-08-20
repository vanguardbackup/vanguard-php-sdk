<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use VanguardBackup\Vanguard\Exceptions\NotFoundException;
use VanguardBackup\Vanguard\Exceptions\TooManyRequestsException;
use VanguardBackup\Vanguard\Exceptions\ValidationException;
use VanguardBackup\Vanguard\Resources\Tag;
use VanguardBackup\Vanguard\VanguardClient;

beforeEach(function () {
    $http = Mockery::mock(Client::class);
    $vanguard = new VanguardClient('123', null, $http);

    return compact('http', 'vanguard');
});

afterEach(function () {
    Mockery::close();
});

test('get tags', function ($http, $vanguard) {
    $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
        new Response(200, [], json_encode(['tags' => [['id' => 1, 'label' => 'Test Tag']]])
        ));

    $tags = $vanguard->tags();

    expect($tags)->toBeArray()->toHaveCount(1)
        ->and($tags[0])->toBeInstanceOf(Tag::class)
        ->and($tags[0]->label)->toBe('Test Tag');
})->with('vanguard');

test('create tag', function ($http, $vanguard) {
    $tagData = ['label' => 'New Tag'];
    $http->shouldReceive('request')->once()->with('POST', 'tags', ['form_params' => $tagData])->andReturn(
        new Response(200, [], json_encode(['tag' => ['id' => 1, 'label' => 'New Tag']]))
    );

    $tag = $vanguard->createTag($tagData);

    expect($tag)->toBeInstanceOf(Tag::class)
        ->and($tag->label)->toBe('New Tag');
})->with('vanguard');

test('update tag', function ($http, $vanguard) {
    $tagData = ['label' => 'Updated Tag'];
    $http->shouldReceive('request')->once()->with('PUT', 'tags/1', ['form_params' => $tagData])->andReturn(
        new Response(200, [], json_encode(['tag' => ['id' => 1, 'label' => 'Updated Tag']]))
    );

    $tag = $vanguard->updateTag('1', $tagData);

    expect($tag)->toBeInstanceOf(Tag::class)
        ->and($tag->label)->toBe('Updated Tag');
})->with('vanguard');

test('delete tag', function ($http, $vanguard) {
    $http->shouldReceive('request')->once()->with('DELETE', 'tags/1', [])->andReturn(
        new Response(200, [], json_encode(['message' => 'Tag deleted successfully']))
    );

    $vanguard->deleteTag('1');

    // If no exception is thrown, the test passes
    expect(true)->toBeTrue();
})->with('vanguard');

test('handling validation errors', function ($http, $vanguard) {
    $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
        new Response(422, [], json_encode([
            'error' => 'Validation Error',
            'message' => 'The given data was invalid.',
            'errors' => ['label' => ['The label field is required.']],
        ]))
    );

    $vanguard->tags();
})->throws(ValidationException::class)->with('vanguard');

test('handling 404 errors', function ($http, $vanguard) {
    $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
        new Response(404)
    );

    $vanguard->tags();
})->throws(NotFoundException::class)->with('vanguard');

test('rate limit exceeded with header set', function ($http, $vanguard) {
    $timestamp = time();

    $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
        new Response(429, ['x-ratelimit-reset' => $timestamp], 'Too Many Attempts.')
    );

    try {
        $vanguard->tags();
    } catch (TooManyRequestsException $e) {
        expect($e->getRateLimitResetsAt())->toBe($timestamp);
    }
})->with('vanguard');

test('rate limit exceeded with header not available', function ($http, $vanguard) {
    $http->shouldReceive('request')->once()->with('GET', 'tags', [])->andReturn(
        new Response(429, [], 'Too Many Attempts.')
    );

    try {
        $vanguard->tags();
    } catch (TooManyRequestsException $e) {
        expect($e->getRateLimitResetsAt())->toBeNull();
    }
})->with('vanguard');

dataset('vanguard', function () {
    $http = Mockery::mock(Client::class);
    $vanguard = new VanguardClient('123', null, $http);

    return [[$http, $vanguard]];
});
