<?php

use Pownall\ReadTime\ReadTime;

it('can set properties on class', function (int $wordCount, int $minutes, int $hours) {
    $readTime = new ReadTime(fake()->words($wordCount, asText: true));

    expect($readTime->wordCount())->toBe($wordCount);
    expect($readTime->minutes())->toBe($minutes);
    expect($readTime->hours())->toBe($hours);
})
    ->with([
        [500, 3, 0],
        [3000, 15, 0],
        [18000, 30, 1],
        [24000, 0, 2],
        [24800, 4, 2],
    ]);

test('calling as string gives readable format', function (int $wordCount, string $expected) {
    $readTime = new ReadTime(fake()->words($wordCount, asText: true));

    expect((string) $readTime)->toBe($expected);
})
    ->with([
        [500, '3 minutes'],
        [3000, '15 minutes'],
        [18000, '1 hour 30 minutes'],
        [24000, '2 hours'],
        [24800, '2 hours 4 minutes'],
    ]);

test('calling get gives readable format', function (int $wordCount, string $expected) {
    $readTime = new ReadTime(fake()->words($wordCount, asText: true));

    expect($readTime->get())->toBe($expected);
})
    ->with([
        [500, '3 minutes'],
        [3000, '15 minutes'],
        [18000, '1 hour 30 minutes'],
        [24000, '2 hours'],
        [24800, '2 hours 4 minutes'],
    ]);

it('can set words per minute', function (int $wordCount, int $minutes, int $hours) {
    $readTime = new ReadTime(fake()->words($wordCount, asText: true), 500);

    expect($readTime->wordsPerMinute())->toBe(500);
    expect($readTime->minutes())->toBe($minutes);
    expect($readTime->hours())->toBe($hours);
})
    ->with([
        [500, 1, 0],
        [3000, 6, 0],
        [18000, 36, 0],
        [24000, 48, 0],
        [24800, 50, 0],
        [30000, 0, 1],
    ]);

test('calling get gives readable format through blade', function (int $wordCount, string $expected) {
    $content = fake()->words($wordCount, asText: true);

    expect(blade("@readtime({$content})"))->toBe($expected);
})
    ->with([
        [500, '3 minutes'],
        [3000, '15 minutes'],
        [18000, '1 hour 30 minutes'],
        [24000, '2 hours'],
        [24800, '2 hours 4 minutes'],
    ]);
